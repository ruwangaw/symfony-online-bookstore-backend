<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShoppintCartDiscounts
 *
 * @ORM\Table(name="shoppint_cart_discounts", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="shopping_cart_discount_discount_foreign_key_1_idx", columns={"discount"}), @ORM\Index(name="shopping_cart_discount_shopping_cart_foreign_key_2_idx", columns={"shopping_cart"})})
 * @ORM\Entity(repositoryClass="App\Repository\ShoppintCartDiscountsRepository")
 */
class ShoppintCartDiscounts
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
     *
     * @ORM\ManyToOne(targetEntity="BookDiscounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="discount", referencedColumnName="id")
     * })
     */
    private $discount;

    /**
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

    public function getDiscount(): ?BookDiscounts
    {
        return $this->discount;
    }

    public function setDiscount(?BookDiscounts $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getShoppingCart(): ?ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(?ShoppingCart $shoppingCart): self
    {
        $this->shoppingCart = $shoppingCart;

        return $this;
    }


}
