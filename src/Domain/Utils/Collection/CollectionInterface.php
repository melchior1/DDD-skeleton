<?php

namespace Domain\Utils\Collection;

interface CollectionInterface
{
    public function isEmpty(): bool;

    public function contains(mixed $element): bool;

    public function count(): int;

    public function toArray():array;


}
