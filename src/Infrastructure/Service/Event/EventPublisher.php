<?php

namespace Infrastructure\Service\Event;

use Domain\Utils\AggregateRoot\AggregateRoot;
use Domain\Utils\Event\EventManagerInterface;
use Infrastructure\Common\Dispatcher\MessageDispatcherInterface;

class EventPublisher
{
    public function __construct(
        private EventManagerInterface $eventManager,
        private MessageDispatcherInterface $messageDispatcher
    ) {
    }

    public function publishEvents(): void
    {
        /** @var AggregateRoot $aggregate */
        foreach ($this->eventManager->getAggregates()->toArray() as $aggregate) {
            foreach ($aggregate->getEvents() as $event) {
                $this->messageDispatcher->dispatchMessage($event);
            }
        }
    }

}
