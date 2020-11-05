<?php

namespace App\Entity;

use App\Repository\TwitterMaxIdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TwitterMaxIdRepository::class)
 */
class TwitterMaxId
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=FilterList::class, inversedBy="twitterMaxIds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filter;

    /**
     * @ORM\Column(type="bigint")
     */
    private ?int $max_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilter(): ?FilterList
    {
        return $this->filter;
    }

    public function setFilter(?FilterList $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    public function getMaxId(): ?int
    {
        return $this->max_id;
    }

    public function setMaxId(string $max_id): self
    {
        $this->max_id = $max_id;

        return $this;
    }
}
