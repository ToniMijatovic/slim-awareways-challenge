<?php

namespace App\Services;

use App\Models\Client;

class ClientService extends Service
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        return $this->client->existsById($id);
    }
}
