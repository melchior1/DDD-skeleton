<?php

namespace Infrastructure\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

trait Uuid
{
    #[ORM\Column(name: 'uuid', type: 'guid', length: 36, unique: true, options: ['index' => true])]
    private string $uuid;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
