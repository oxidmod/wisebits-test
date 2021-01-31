<?php
declare(strict_types=1);

namespace App\Service\Hit;

interface HitStorageInterface
{
    public function addHit(string $country): void;

    /**
     * @return int[]
     */
    public function getAllHits(): array;
}
