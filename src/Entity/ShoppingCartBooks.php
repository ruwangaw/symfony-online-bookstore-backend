<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShoppingCartBooks
 *
 * @ORM\Table(name="shopping_cart_books", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="shopping_cart_froeign_key_1_idx", columns={"shopping_cart"}), @ORM\Index(name="book_foreign_key_2_idx", columns={"book"})})
 * @ORM\Entity(repositoryClass="App\Repository\ShoppingCartBooksRepository")
 */
class ShoppingCartBooks
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
     * @ORM\Column(name="item_count", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $itemCount;

    /**
     * @var string
     *
     * @ORM\Column(name="calculated_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $calculatedPrice;

    /**
     * @var \Books
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book", referencedColumnName="id")
     * })
     */
    private $book;

    /**
     * @var \ShoppingCart
     *
     * @ORM\ManyToOne(targetEntity="ShoppingCart")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shopping_cart", referencedColumnName="id")
     * })
     */
    private $shoppingCart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemCount(): ?int
    {
        return $this->itemCount;
    }

    public function setItemCount(int $itemCount): self
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    public function getCalculatedPrice(): ?string
    {
        return $this->calculatedPrice;
    }

    public function setCalculatedPrice(string $calculatedPrice): self
    {
        $this->calculatedPrice = $calculatedPrice;

        return $this;
    }

    public function getBook()
    {
        return $this->book;
    }

    public function setBook(?Books $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getShoppingCart()
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(?ShoppingCart $shoppingCart): self
    {
        $this->shoppingCart = $shoppingCart;

        return $this;
    }


}
