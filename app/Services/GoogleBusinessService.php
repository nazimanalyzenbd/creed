<?php

namespace App\Services;

use Google\Client;
use Google\Service\MyBusinessAccountManagement;

class GoogleBusinessService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->addScope('https://www.googleapis.com/auth/business.manage'); // Correct scope

        // Fetch the stored access token (e.g., from the database)
        $accessToken = '1|6DT0SA1dJ5Iqf1BkYxDxYTFyZw3EsmrfgaHprptbc6dd3aa3';
        $this->client->setAccessToken($accessToken);

        // Refresh the token if it's expired
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = '1|6DT0SA1dJ5Iqf1BkYxDxYTFyZw3EsmrfgaHprptbc6dd3aa3';
            $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
        }
    }

    

    public function fetchBusinessProfiles()
    {
        $service = new MyBusinessAccountManagement($this->client);

        try {
            // Use the accounts resource
            $accounts = $service->accounts->listAccounts();
       
            return $accounts->getAccounts(); // Returns a list of accounts
        } catch (\Exception $e) {
            throw new \Exception('Error fetching business profiles: ' . $e->getMessage());
        }
    }
}
