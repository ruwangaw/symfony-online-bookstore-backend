<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="invoice_shopping_cart_foreign_key_1_idx", columns={"shopping_cart"}), @ORM\Index(name="invoice_receipt_status_foreign_key_2_idx", columns={"receipt_status"})})
 * @ORM\Entity
 */
class Invoice
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="txn_at", type="string", length=45, nullable=true)
     */
    private $txnAt;

    /**
     * @var int
     *
     * @ORM\Column(name="paid_amount", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $paidAmount;

    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="MstInvoiceStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="receipt_status", referencedColumnName="id")
     * })
     */
    private $receiptStatus;

    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ShoppingCart")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shopping_cart", referencedColumnName="id")
     * })
     */
    private $shoppingCart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTxnAt(): ?string
    {
        return $this->txnAt;
    }

    public function setTxnAt(?string $txnAt): self
    {
        $this->txnAt = $txnAt;

        return $this;
    }

    public function getPaidAmount(): ?int
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(int $paidAmount): self
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    public function getReceiptStatus(): ?MstInvoiceStatus
    {
        return $this->receiptStatus;
    }

    public function setReceiptStatus(?MstInvoiceStatus $receiptStatus): self
    {
        $this->receiptStatus = $receiptStatus;

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
