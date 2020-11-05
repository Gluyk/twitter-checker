<?php

namespace App\Entity;

use App\Repository\TwitterContentRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TwitterContentRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"read"}}
 * )
 */
class TwitterContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private ?\DateTimeInterface $created_at;

    /**
     * @ORM\Column(type="bigint")
     * @Groups("read")
     */
    private ?int $original_id;

    /**
     * @ORM\Column(type="text")
     * @Groups("read")
     */
    private ?string $text;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("read")
     */
    private ?string $user_screen_name;

    /**
     * @ORM\ManyToOne(targetEntity=FilterList::class, inversedBy="filter_id")
     */
    private FilterList $filter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getOriginalId(): ?int
    {
        return $this->original_id;
    }

    public function setOriginalId(int $original_id): self
    {
        $this->original_id = $original_id;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUserScreenName(): ?string
    {
        return $this->user_screen_name;
    }

    public function setUserScreenName(string $user_screen_name): self
    {
        $this->user_screen_name = $user_screen_name;

        return $this;
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
}
