<?php
declare(strict_types=1);

namespace App\Request\Dto;

use App\Request\RequestDtoInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class HitRequest implements RequestDtoInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Country()
     */
    public string $country;

    public function __construct(Request $request)
    {
        $this->country = strtoupper((string)$request->get('country', ''));
    }
}
