<?php

namespace Infrastructure\Common\Dispatcher;

use Domain\Utils\Message\Attributes\BusInterface;
use Domain\Utils\Message\MessageInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

final class MessengerDispatcher implements MessageDispatcherInterface, ServiceSubscriberInterface
{

    public function __construct(
        private ContainerInterface $locator
    ) {
    }

    public function dispatchMessage(MessageInterface $message): mixed
    {
        $envelop = $this->getBus($message)->dispatch($message);
        /** @var HandledStamp $stamp */
        $stamp = $envelop->last(HandledStamp::class);
        return $stamp?->getResult();
    }

    private function getBus(MessageInterface $message): MessageBusInterface
    {
        $class = new \ReflectionClass($message);
        $attributes = $class->getAttributes();
        /** @var ?BusInterface $busType */
        $busType = isset($attributes[0]) ? $attributes[0]->newInstance() : null;

        if (is_null($busType)) {
            throw new \LogicException('no bus specified for this message');
        }

        return $this->locator->get($busType->getBus());
    }

    public static function getSubscribedServices(): array
    {
        return [
            'commandBus' => '?' . MessageBusInterface::class,
            'queryBus' => '?' . MessageBusInterface::class,
            'eventBus' => '?' . MessageBusInterface::class,
        ];
    }

}
