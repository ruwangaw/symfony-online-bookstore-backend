<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BookDiscounts
 *
 * @ORM\Table(name="book_discounts", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="book_discounts_books_category_foreign_key_2_idx", columns={"book_category"})})
 * @ORM\Entity
 */
class BookDiscounts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="minimum_books_count", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $minimumBooksCount;

    /**
     * @var int|null
     *
     * @ORM\Column(name="coupon_discount", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $couponDiscount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="coupon_code", type="string", length=10, nullable=true)
     */
    private $couponCode;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_percentage", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $discountPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="starts_at", type="string", length=45, nullable=false)
     */
    private $startsAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ends_at", type="string", length=45, nullable=false)
     */
    private $endsAt;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * @var string|null
     *
     * @ORM\Column(name="created_at", type="string", length=45, nullable=true)
     */
    private $createdAt;

    /**
     *
     * @ORM\ManyToOne(targetEntity="MstBookCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book_category", referencedColumnName="id")
     * })
     */
    private $bookCategory;

    /**
     * 
     * 
     * Many BookDiscounts have Many ShoppingCarts.
     * @ORM\ManyToMany(targetEntity="ShoppingCart", mappedBy="bookDiscounts")
     */
    private $shoppingCarts;

    public function __construct() {
        $this->shoppingCarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinimumBooksCount(): ?int
    {
        return $this->minimumBooksCount;
    }

    public function setMinimumBooksCount(int $minimumBooksCount): self
    {
        $this->minimumBooksCount = $minimumBooksCount;

        return $this;
    }

    public function getCouponDiscount(): ?int
    {
        return $this->couponDiscount;
    }

    public function setCouponDiscount(?int $couponDiscount): self
    {
        $this->couponDiscount = $couponDiscount;

        return $this;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): self
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    public function getDiscountPercentage(): ?string
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(string $discountPercentage): self
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    public function getStartsAt(): ?string
    {
        return $this->startsAt;
    }

    public function setStartsAt(string $startsAt): self
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    public function getEndsAt(): ?string
    {
        return $this->endsAt;
    }

    public function setEndsAt(string $endsAt): self
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBookCategory(): ?MstBookCategories
    {
        return $this->bookCategory;
    }

    public function setBookCategory(?MstBookCategories $bookCategory): self
    {
        $this->bookCategory = $bookCategory;

        return $this;
    }

    /**
     * @return Collection|ShoppingCart[]
     */
    public function getShoppingCarts(): Collection
    {
        return $this->shoppingCarts;
    }

    public function addShoppingCart(ShoppingCart $shoppingCart): self
    {
        if (!$this->shoppingCarts->contains($shoppingCart)) {
            $this->shoppingCarts[] = $shoppingCart;
            $shoppingCart->addBookDiscount($this);
        }

        return $this;
    }

    public function removeShoppingCart(ShoppingCart $shoppingCart): self
    {
        if ($this->shoppingCarts->removeElement($shoppingCart)) {
            $shoppingCart->removeBookDiscount($this);
        }

        return $this;
    }


}
