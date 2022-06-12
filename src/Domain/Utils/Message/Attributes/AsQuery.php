<?php

namespace Domain\Utils\Message\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class AsQuery implements BusInterface
{
    public const BUS = 'queryBus';


    public function getBus(): string
    {
        return self::BUS;
    }

}
