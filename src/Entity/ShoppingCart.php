<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ShoppingCart
 *
 * @ORM\Table(name="shopping_cart", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="shopping_cart_user_foreign_key_idx", columns={"user"})})
 * @ORM\Entity(repositoryClass="App\Repository\ShoppingCartRepository")
 */
class ShoppingCart
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
     * @var string
     *
     * @ORM\Column(name="total_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $totalAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $discountAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="gross_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $grossAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", length=45, nullable=false)
     */
    private $createdAt;

    /**
     * 
     *
     * Many shopping carts has one user
     * @ORM\ManyToOne(targetEntity="User" , inversedBy="shoppingCarts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * Many Shopping carts have many Books
     * @ORM\ManyToMany(targetEntity="Books", mappedBy="shoppingCarts")
     */
    private $books;

    /**
     * Many Shopping carts have Many book discounts.
     * @ORM\ManyToMany(targetEntity="BookDiscounts", inversedBy="shoppingCarts")
     * @ORM\JoinTable(name="shoppint_cart_discounts")
     */
    private $bookDiscounts;

    public function __construct() {
        $this->books = new ArrayCollection();
        $this->bookDiscounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalAmount(): ?string
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(string $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getDiscountAmount(): ?string
    {
        return $this->discountAmount;
    }

    public function setDiscountAmount(string $discountAmount): self
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    public function getGrossAmount(): ?string
    {
        return $this->grossAmount;
    }

    public function setGrossAmount(string $grossAmount): self
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Books[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Books $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addShoppingCart($this);
        }

        return $this;
    }

    public function removeBook(Books $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeShoppingCart($this);
        }

        return $this;
    }

    /**
     * @return Collection|BookDiscounts[]
     */
    public function getBookDiscounts(): Collection
    {
        return $this->bookDiscounts;
    }

    public function addBookDiscount(BookDiscounts $bookDiscount): self
    {
        if (!$this->bookDiscounts->contains($bookDiscount)) {
            $this->bookDiscounts[] = $bookDiscount;
        }

        return $this;
    }

    public function removeBookDiscount(BookDiscounts $bookDiscount): self
    {
        $this->bookDiscounts->removeElement($bookDiscount);

        return $this;
    }


}
