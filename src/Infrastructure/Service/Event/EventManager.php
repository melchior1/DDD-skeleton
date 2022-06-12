<?php

namespace Infrastructure\Service\Event;

use Application\Shared\EventManager\AggregateCollection;
use Domain\Utils\AggregateRoot\AggregateRoot;
use Domain\Utils\Collection\AggregateCollectionInterface;
use Domain\Utils\Event\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    public function __construct(private AggregateCollectionInterface $aggregates)
    {
        
    }

    public function persist(AggregateRoot $aggregateRoot): void
    {
        $this->aggregates->add($aggregateRoot);
    }

    public function clear(): void
    {
        $this->aggregates->clear();
    }

    public function hasEvent(): bool
    {
        /** @var AggregateRoot $aggregate */
        foreach ($this->aggregates->toArray() as $aggregate) {
            if ($aggregate->hasDomainEvent()) {
                return true;
            }
        }

        return false;
    }

    public function getAggregates(): AggregateCollectionInterface
    {
        return $this->aggregates;
    }
}
