<?php

namespace Domain\Utils\Collection;

use Domain\Utils\AggregateRoot\AggregateRoot;

interface AggregateCollectionInterface extends CollectionInterface
{
    public function clear(): void;
    public function add(AggregateRoot $aggregateRoot): self;


}
