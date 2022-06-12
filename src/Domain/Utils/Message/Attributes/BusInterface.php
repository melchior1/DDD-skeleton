<?php

namespace Domain\Utils\Message\Attributes;

interface BusInterface
{
    public function getBus(): string;

}
