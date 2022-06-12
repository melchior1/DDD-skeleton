<?php

namespace Infrastructure\Listener;

use Infrastructure\Common\Response\ResponseManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener(event: 'kernel.exception')]
class ExceptionListener
{
    public function __construct(private ResponseManagerInterface $responseManager)
    {
    }


    public function onKernelException(ExceptionEvent $event): JsonResponse
    {
        if ($event->getThrowable() instanceof \Exception) {
            $exception = $event->getThrowable();
        } elseif ($event->getThrowable()->getPrevious() instanceof \Exception) {
            $exception = $event->getThrowable()->getPrevious();
        } else {
            $exception = null;
        }
        //todo add log here
        return $this->responseManager->error(
            [
                'message' => $exception?->getMessage(),
                'errorCode' => $exception?->getCode()
            ]
        );
    }

}
