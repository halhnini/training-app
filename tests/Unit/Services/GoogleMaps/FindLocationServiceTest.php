<?php

namespace App\Tests\Unit\Services\GoogleMaps;

use App\Entities\LocationCollection;
use App\Services\GoogleMaps\ApiServiceInterface;
use App\Services\GoogleMaps\LocationService;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class FindLocationServiceTest extends TestCase
{
    public function test_search_location_return_location_collection()
    {
        $apiService = $this->createMock(ApiServiceInterface::class);
        $apiService->method('get')->willReturn($this->getData());
        $findLocationService = new LocationService($apiService);

        $locationCollection = $findLocationService->searchLocation("test");
        $this->assertInstanceOf(LocationCollection::class, $locationCollection);
    }

    private function getData()
    {
        return [
            "results" => [
                [
                    "formatted_address" => "address 1",
                    "geometry" => [
                        "location" => [
                            "lat" => "12.55998",
                            "lng" => "15.5555"
                        ],
                    ],
                    "place_id" => "114563",
                ],
                [
                    "formatted_address" => "address 2",
                    "geometry" => [
                        "location" => [
                            "lat" => "12.55998",
                            "lng" => "15.5555"
                        ],
                    ],
                    "place_id" => "54896",
                ]
            ]
        ];
    }
}
