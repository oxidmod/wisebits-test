<?php
declare(strict_types=1);

namespace App\Response\Dto;

class Error implements \JsonSerializable
{
    public string $error;

    public array $details;

    public function __construct(string $error, array $details = [])
    {
        $this->error = $error;
        $this->details = $details;
    }

    public function jsonSerialize()
    {
        return (array)$this;
    }
}
