<?php

namespace Domain\Utils\AggregateRoot;

abstract class AggregateRoot
{
    protected array $domainEvents;

    protected function addEvent(object $domainEvent): static
    {
        $this->domainEvents[] = $domainEvent;
        return $this;
    }

    public function getEvents(): array
    {
        return $this->domainEvents;
    }

    public function hasDomainEvent(): bool
    {
        return !empty($this->domainEvents);
    }
}
