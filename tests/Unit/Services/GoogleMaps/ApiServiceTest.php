<?php

namespace App\Tests\Unit\Services\GoogleMaps;

use App\Services\GoogleMaps\GoogleApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class ApiServiceTest extends TestCase
{
    public function test_api_service_retries_three_times_before_failing_to_connect_to_host()
    {
        $mock = new MockHandler([
            new ConnectException("Error Communicating with Server", new Request('GET', 'test')),
            new ConnectException("Error Communicating with Server", new Request('GET', 'test')),
            new ConnectException("Error Communicating with Server", new Request('GET', 'test')),
            new Response(200, [], '{"data":"data"}'),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $apiService = new GoogleApiService($client);

        try {
            $apiService->get("test",[]);
            $this->fail("Should throw exception after 3 retries");
        } catch (ConnectException $e) {
            $this->assertEquals("Error Communicating with Server", $e->getMessage());
        }
    }
}
