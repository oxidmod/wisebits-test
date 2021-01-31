<?php
declare(strict_types=1);

namespace App\Controller;

use App\Request\Dto\HitRequest;
use App\Service\Hit\HitStorageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HitController
{
    /**
     * @Route(path="/hits/{country}", name="hit.country")
     *
     * @param HitStorageInterface $hitStorage
     * @param HitRequest $request
     * @return Response
     */
    public function hit(HitStorageInterface $hitStorage, HitRequest $request): Response
    {
        $hitStorage->addHit($request->country);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    /**
     * @Route(path="/hits", methods={"GET"}, name="hit.all")
     *
     * @param HitStorageInterface $hitStorage
     * @return Response
     */
    public function showHits(HitStorageInterface $hitStorage): Response
    {
        return new JsonResponse($hitStorage->getAllHits());
    }
}
