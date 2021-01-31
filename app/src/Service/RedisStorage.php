<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Hit\HitStorageInterface;
use Redis;

class RedisStorage implements HitStorageInterface
{
    private string $hashName;
    private Redis $client;

    public function __construct(string $hashName, Redis $client)
    {
        $this->hashName = $hashName;
        $this->client = $client;
    }

    public function addHit(string $country): void
    {
        $this->client->hIncrBy($this->hashName, $country, 1);
    }

    public function getAllHits(): array
    {
        return $this->client->hGetAll($this->hashName);
    }
}
