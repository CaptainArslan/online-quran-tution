<?php

namespace App\Services;

use GoCardlessPro\Client;
use GoCardlessPro\Resources\Customer;

class GoCardlessService
{
    protected $client;

    public function __construct()
    {
        $accessToken = config('services.gocardless.access_token');
        $environment = config('services.gocardless.environment');

        $this->client = new Client([
            'access_token' => $accessToken,
            'environment' => $environment,
        ]);
    }

    public function getCustomer($customerId): ?Customer
    {
        try {
            return $this->client->customers()->get($customerId);
        } catch (\Exception $e) {
            // Handle error
            return null;
        }
    }
    public function getAllCustomers(): array
    {
        try {
            $response = $this->client->customers()->list();
            return $response->records;
        } catch (\Exception $e) {
            // Handle error
            return [];
        }
    }
}
