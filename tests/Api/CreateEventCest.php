<?php


namespace App\Tests\Api;

use App\Tests\ApiTester;

class CreateEventCest
{

    public function createEventViaAPI(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPost('/events', [
            'title' => 'Test',
            'date' => '2023-01-21 10:01:19',
            'city' => 'Test City'
        ]);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('"title":"Test"');

    }

    public function badRequestEventViaAPI(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPost('/events', [
            'wrong_name' => 'Test',
            'date' => '2023-01-21 10:01:19',
            'city' => 'Test City'
        ]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"error":"Bad Request"');

    }
}
