<?php

namespace App\Controller\Api;

use App\DTO\Response\Transformer\TicketResponseTransformer;

use App\Repository\TicketRepository;
use App\Service\Serializer\DTOSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController
{
    public function __construct(
        private TicketRepository $repository,
        private TicketResponseTransformer $ticketTransformer
    ) {
    }

    #[Route('/ticket', name: 'createTicket', methods: 'POST')]
    public function createAction(Request $request, DTOSerializer $serializer): Response
    {
        if($request->headers->has('force_fail')) {
            return new JsonResponse(
                ['error' => 'Not found'],
                $request->headers->get('force_fail')
            );
        }

        $event = $serializer->deserialize($request->getContent(), \App\DTO\Response\Event::class, 'json');
        dd($event);

        $this->repository->save($event);

        return new Response(
            $serializer->serialize($this->eventResponseTransformer->transformFromObject($event) , 'json'),
            200,
            ['Content-Type' => 'application/json']
        );
    }

}
