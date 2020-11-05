<?php

namespace App\Entity;

use App\Repository\FilterListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilterListRepository::class)
 */
class FilterList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilter(): ?string
    {
        return $this->filter;
    }

    public function setFilter(string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }
}
