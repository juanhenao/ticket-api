<?php


namespace App\Tests\Api;

use App\Tests\ApiTester;
use Codeception\Attribute\Incomplete;

class CreateTicketCest
{

    private int $eventId;

    public function _before() {
        $this->eventId = 1;
    }

    #[Incomplete('Make sure that event exists')]
    public function createTicketViaAPI(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPost('api/v1/events/' .$this->eventId . '/tickets', [
            'barcode' => '11111111111',
            'name' => 'Tester',
            'lastname' => 'Test'
        ]);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('"firstname":"Tester"');

    }

    public function badRequestMissingNameTicketViaAPI(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPost('api/v1/events/' .$this->eventId . '/tickets', [
            'barcode' => '11111111111',
            'lastname' => 'Test'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"error":"Bad Request"');

    }

    public function unexistentEventTicketViaAPI(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPost('api/v1/events/0/tickets', [
            'barcode' => '11111111111',
            'name' => 'Tester',
            'lastname' => 'Test'
        ]);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"error":"Event not found"');

    }
}
