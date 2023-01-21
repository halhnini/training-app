<?php

namespace App\Services\GoogleMaps;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class GoogleApiService implements ApiServiceInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ApiServiceImpl constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Call an API and return array from JSON response.
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    public function get(string $endpoint, array $params): array
    {
        $attempts = 0;
        $maxAttempts = config('services.google.max_attempts');
        //var_dump($maxAttempts);die;
        $backoff = 2;
        while ($attempts < $maxAttempts) {
            try {
                Log::debug("Calling API endpoint: " . $endpoint . " with params: " . json_encode($params));
                $response = $this->client->get($endpoint, [
                    'query' => $params
                ]);
                return json_decode($response->getBody()->getContents(), true);
            } catch (ConnectException $e) {
                Log::error("API call failed with endpoint: " . $endpoint . " and params: " . json_encode($params) . " Exception: " . $e->getMessage());
                $attempts++;
                if ($attempts < $maxAttempts) {
                    sleep($backoff);
                    $backoff *= 2;
                } else {
                    throw $e;
                }
            }
        }
    }
}
