<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_add_product;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name_product;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $text_product;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="product_",orphanRemoval=true, cascade={"persist"})
     */
    private $reviews;
   
    private $avarageEstimate;

    public function __construct()
    {
        $this->date_add_product=new DateTime();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAverageValue()
    {
        $divisor=0;
        $reviews=$this->getReviews();
        $average_count = 0;
        foreach ($reviews as $review)
        {
            $average_count += $review->getRating();
            $divisor++;
        }
        if ($divisor==0)
        $average_count=0;
        else {
        $average_count = $average_count / $divisor;
        }
        return ($average_count);
    }
    public function getDateAddProduct(): ?\DateTimeInterface
    {
        return $this->date_add_product;
    }

    public function setDateAddProductValue()
    {
        $this->date_add_product=new \DateTime();
    }

    public function setDateAddProduct(\DateTimeInterface $date_add_product): self
    {
        $this->date_add_product = $date_add_product;

        return $this;
    }

    public function getNameProduct(): ?string
    {
        return $this->name_product;
    }

    public function setNameProduct(string $name_product): self
    {
        $this->name_product = $name_product;

        return $this;
    }

    public function getTextProduct(): ?string
    {
        return $this->text_product;
    }

    public function setTextProduct(string $text_product): self
    {
        $this->text_product = $text_product;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }
    public function getAvarageEstimate()
    {
        return $this->avarageEstimate;
    }
    public function setAvarageEstimate($avarageEstimate): void
    {
        $this->avarageEstimate = $avarageEstimate;
    }
}
