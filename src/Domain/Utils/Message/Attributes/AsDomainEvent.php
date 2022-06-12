<?php

namespace Domain\Utils\Message\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class AsDomainEvent implements BusInterface
{
    public const BUS = 'eventBus';


    public function getBus(): string
    {
        return self::BUS;
    }

}
