<?php

namespace Domain\Utils\Event;

use Domain\Utils\AggregateRoot\AggregateRoot;
use Domain\Utils\Collection\AggregateCollectionInterface;

interface EventManagerInterface
{

    public function persist(AggregateRoot $aggregateRoot): void;

    public function clear(): void;

    public function hasEvent(): bool;

    public function getAggregates(): AggregateCollectionInterface;

}
