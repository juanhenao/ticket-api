<?php

namespace App\Controller\Api;

use App\DTO\Response\Transformer\EventDetailedResponseTransformer;
use App\DTO\Response\Transformer\EventResponseTransformer;
use App\DTO\Response\Transformer\TicketResponseTransformer;
use App\Entity\Event;
use App\Entity\Ticket;
use App\Repository\EventRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EventController extends AbstractController
{
    public function __construct(
        private EventRepository $repository,
        private EntityManagerInterface $entityManager,
        private EventDetailedResponseTransformer $eventDetailedResponseTransformer,
        private EventResponseTransformer $eventResponseTransformer,
        private TicketResponseTransformer $ticketResponseTransformer,
        private ValidatorInterface $validator
    ) {
    }

    #[Route('/events', name: 'listEvents', methods: 'GET')]
    public function indexAction(Request $request, DTOSerializer $serializer): Response
    {
        $events = $this->repository->findAll();

        return new Response(
            $serializer->serialize($this->eventResponseTransformer->transformFromObjects($events) , 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/events/{id}', name: 'events', requirements: ['id' => '\d+'], methods: 'GET')]
    public function listAction(Request $request, int $id, DTOSerializer $serializer): Response
    {
        $event = $this->repository->find($id);

        if($event === null){
            return new JsonResponse(
                ['error' => 'Not found'],
                404
            );
        }

        return new Response(
            $serializer->serialize($this->eventDetailedResponseTransformer->transformFromObject($event) , 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/events', name: 'saveEvent',methods: 'POST')]
    public function createAction(Request $request, SerializerInterface $serializer): Response
    {
        try{
            /** @var Event $event */
            $event = $serializer->deserialize($request->getContent(), Event::class, 'json');
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'Bad Request'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $errors = $this->validator->validate($event);

        if(count($errors) > 0){
            $message = $errors[0]->getPropertyPath() . ': ' . $errors[0]->getMessage();

            return new JsonResponse(
                ['error' => 'Bad Request', 'message' => $message],
                Response::HTTP_BAD_REQUEST
            );
        }

        $this->repository->save($event, true);

        return new Response(
            $serializer->serialize($this->eventResponseTransformer->transformFromObject($event) , 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/events/{id}/tickets', name: 'createTicket', requirements: ['id' => '\d+'], methods: 'POST')]
    public function addTicket(Request $request, DTOSerializer $serializer, int $id): Response
    {
        $event = $this->repository->find($id);

        if($event === null){
            return new JsonResponse(
                ['error' => 'Event not found'],
                404
            );
        }

        try{
            /** @var Ticket $ticket */
            $ticket = $serializer->deserialize($request->getContent(), Ticket::class, 'json');
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' => 'Bad Request'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $errors = $this->validator->validate($ticket);

        if(count($errors) > 0){
            $message = $errors[0]->getPropertyPath() . ': ' . $errors[0]->getMessage();

            return new JsonResponse(
                ['error' => 'Bad Request', 'message' => $message],
                Response::HTTP_BAD_REQUEST
            );
        }

        $ticket->setEvent($event);

        $this->entityManager->getRepository(Ticket::class)->save($ticket, true);

        return new Response(
            $serializer->serialize($this->ticketResponseTransformer->transformFromObject($ticket) , 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
