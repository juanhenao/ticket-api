<?php


namespace App\Tests\Api;

use App\Tests\ApiTester;
use Codeception\Attribute\Incomplete;

class RetrieveEventsCest
{

    private int $eventId;

    public function _before() {
        $this->eventId = 1;
    }

    public function listAllEvents(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendGet('api/v1/events');
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();

    }

    #[Incomplete('Make sure that event exists')]
    public function getSingleEvent(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPost('api/v1/events/' .$this->eventId . '/tickets', [
            'barcode' => '11111111111',
            'lastname' => 'Test'
        ]);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('"tickets"');

    }

}
