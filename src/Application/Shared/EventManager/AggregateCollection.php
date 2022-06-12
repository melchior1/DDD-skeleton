<?php

namespace Application\Shared\EventManager;

use Domain\Utils\AggregateRoot\AggregateRoot;
use Domain\Utils\Collection\AggregateCollectionInterface;

final class AggregateCollection implements AggregateCollectionInterface
{

    private array $aggregates = [];

    public function clear(): void
    {
        $this->aggregates = [];
    }

    public function add(AggregateRoot $aggregateRoot): self
    {
        $this->aggregates[] = $aggregateRoot;
        return $this;
    }

    public function isEmpty(): bool
    {
        return count($this->aggregates) === 0;
    }

    public function contains(mixed $element): bool
    {
        return in_array($this->aggregates, $element);
    }

    public function count(): int
    {
        return count($this->aggregates);
    }

    public function toArray(): array
    {
        return $this->aggregates;
    }
}
