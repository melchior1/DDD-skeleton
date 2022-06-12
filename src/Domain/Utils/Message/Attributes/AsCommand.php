<?php

namespace Domain\Utils\Message\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class AsCommand implements BusInterface
{
    public const BUS = 'commandBus';

    public function getBus(): string
    {
        return self::BUS;
    }


}
