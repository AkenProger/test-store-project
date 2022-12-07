<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'manufacturer')]
    private ?Manufacturer $manufacturer = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Categories $category = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductImages::class)]
    private Collection $OneToMany;

    public function __construct()
    {
        $this->OneToMany = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getCategory(): ?Categories
    {
        return $this->category;
    }

    public function setCategory(?Categories $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, ProductImages>
     */
    public function getOneToMany(): Collection
    {
        return $this->OneToMany;
    }

    public function addOneToMany(ProductImages $oneToMany): self
    {
        if (!$this->OneToMany->contains($oneToMany)) {
            $this->OneToMany->add($oneToMany);
            $oneToMany->setProduct($this);
        }

        return $this;
    }

    public function removeOneToMany(ProductImages $oneToMany): self
    {
        if ($this->OneToMany->removeElement($oneToMany)) {
            // set the owning side to null (unless already changed)
            if ($oneToMany->getProduct() === $this) {
                $oneToMany->setProduct(null);
            }
        }

        return $this;
    }
}
