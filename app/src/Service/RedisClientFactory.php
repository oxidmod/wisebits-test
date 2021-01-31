<?php
declare(strict_types=1);

namespace App\Service;

use Redis;

class RedisClientFactory
{
    public function create(string $host, int $port): Redis
    {
        $client = new Redis();
        $client->connect($host, $port);

        return $client;
    }
}
