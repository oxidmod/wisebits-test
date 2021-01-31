<?php
declare(strict_types=1);

namespace App\Events;

use App\Response\ErrorResponseFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class KernelEventSubscriber implements EventSubscriberInterface
{
    private ErrorResponseFactory $errorResponseFactory;

    public function __construct(ErrorResponseFactory $errorResponseFactory)
    {
        $this->errorResponseFactory = $errorResponseFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->getContentType() != 'json' || !$request->getContent()) {
            return;
        }

        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new BadRequestHttpException('Invalid JSON body was received', $exception);
        }

        $request->request->replace(is_array($data) ? $data : []);
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $event->setResponse(
            $this->errorResponseFactory->createResponseFromException($event->getThrowable())
        );
    }
}
