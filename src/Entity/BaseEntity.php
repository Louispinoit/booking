<?php

namespace App\Entity;

use App\Repository\BaseEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass()]
abstract class BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected  ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

}
