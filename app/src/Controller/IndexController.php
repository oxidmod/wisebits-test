<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route(path="/", name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return new JsonResponse([
            'hit.country' => 'Send any request to http://localhost:5555/hits/{country}',
            'hit.all' => 'Send GET request to http://localhost:5555/hits',
        ]);
    }
}
