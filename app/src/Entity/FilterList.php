<?php

namespace App\Entity;

use App\Repository\FilterListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $filter;

    /**
     * @ORM\OneToMany(targetEntity=TwitterContent::class, mappedBy="filter")
     */
    private $filter_id;

    /**
     * @ORM\OneToMany(targetEntity=TwitterMaxId::class, mappedBy="filter", orphanRemoval=true)
     */
    private $twitterMaxIds;

    public function __construct()
    {
        $this->filter_id = new ArrayCollection();
        $this->twitterMaxIds = new ArrayCollection();
    }

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

    /**
     * @return Collection|TwitterContent[]
     */
    public function getFilterId(): Collection
    {
        return $this->filter_id;
    }

    public function addFilterId(TwitterContent $filterId): self
    {
        if (!$this->filter_id->contains($filterId)) {
            $this->filter_id[] = $filterId;
            $filterId->setFilter($this);
        }

        return $this;
    }

    public function removeFilterId(TwitterContent $filterId): self
    {
        if ($this->filter_id->removeElement($filterId)) {
            // set the owning side to null (unless already changed)
            if ($filterId->getFilter() === $this) {
                $filterId->setFilter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TwitterMaxId[]
     */
    public function getTwitterMaxIds(): Collection
    {
        return $this->twitterMaxIds;
    }

    public function addTwitterMaxId(TwitterMaxId $twitterMaxId): self
    {
        if (!$this->twitterMaxIds->contains($twitterMaxId)) {
            $this->twitterMaxIds[] = $twitterMaxId;
            $twitterMaxId->setFilter($this);
        }

        return $this;
    }

    public function removeTwitterMaxId(TwitterMaxId $twitterMaxId): self
    {
        if ($this->twitterMaxIds->removeElement($twitterMaxId)) {
            // set the owning side to null (unless already changed)
            if ($twitterMaxId->getFilter() === $this) {
                $twitterMaxId->setFilter(null);
            }
        }

        return $this;
    }
}
