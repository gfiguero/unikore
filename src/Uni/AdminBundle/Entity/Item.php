<?php

namespace Uni\AdminBundle\Entity;

/**
 * Item
 */
class Item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $discount;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DateTime
     */
    private $deleted_at;

    public function __toString()
    {
        return (string) $this->id;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     *
     * @return Item
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Item
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Item
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Item
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deleted_at = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    /**
     * @var \Uni\AdminBundle\Entity\Budget
     */
    private $budget;

    /**
     * @var \Uni\AdminBundle\Entity\Product
     */
    private $product;


    /**
     * Set budget
     *
     * @param \Uni\AdminBundle\Entity\Budget $budget
     *
     * @return Item
     */
    public function setBudget(\Uni\AdminBundle\Entity\Budget $budget = null)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return \Uni\AdminBundle\Entity\Budget
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set product
     *
     * @param \Uni\AdminBundle\Entity\Product $product
     *
     * @return Item
     */
    public function setProduct(\Uni\AdminBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Uni\AdminBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get discountPrice
     *
     * @return integer
     */
    public function getDiscountPrice()
    {
        return round(($this->getPrice()/1.19) * ($this->getDiscount()/100));
    }

    /**
     * Get totalDiscountPrice
     *
     * @return integer
     */
    public function getTotalDiscountPrice()
    {
        return $this->getQuantity() * (($this->getPrice()/1.19) * ($this->getDiscount()/100));
    }

    /**
     * Get netPrice
     *
     * @return integer
     */
    public function getNetPrice()
    {
        return round(($this->getPrice()/1.19) - (($this->getPrice()/1.19) * ($this->getDiscount()/100)) + $this->getSurcharge());
    }

    /**
     * Get totalNetPrice
     *
     * @return integer
     */
    public function getTotalNetPrice()
    {
        return round($this->getQuantity() * (($this->getPrice()/1.19) - (($this->getPrice()/1.19) * ($this->getDiscount()/100)) + $this->getSurcharge()));
    }

    /**
     * Get iva
     *
     * @return integer
     */
    public function getIva()
    {
        return round((($this->getPrice()/1.19) - (($this->getPrice()/1.19) * ($this->getDiscount()/100)) + $this->getSurcharge()) * 0.19);
    }

    /**
     * Get totalIva
     *
     * @return integer
     */
    public function getTotalIva()
    {
        return round($this->getQuantity() * ((($this->getPrice()/1.19) - (($this->getPrice()/1.19) * ($this->getDiscount()/100)) + $this->getSurcharge()) * 0.19));
    }

    /**
     * Get normalFullPrice
     *
     * @return integer
     */
    public function getNormalFullPrice()
    {
        return round(($this->getPrice()/1.19) + $this->getSurcharge());
    }

    /**
     * Get totalNormalFullPrice
     *
     * @return integer
     */
    public function getTotalNormalFullPrice()
    {
        return round($this->getQuantity() * (($this->getPrice()/1.19) + $this->getSurcharge()));
    }

    /**
     * Get totalNormalPrice
     *
     * @return integer
     */
    public function getTotalNormalPrice()
    {
        return round($this->getQuantity() * ($this->getPrice()/1.19));
    }

    /**
     * Get totalListPrice
     *
     * @return integer
     */
    public function getTotalListPrice()
    {
        return round($this->getQuantity() * $this->getPrice());
    }

    /**
     * Get totalSurcharge
     *
     * @return integer
     */
    public function getTotalSurcharge()
    {
        return round($this->getQuantity() * ($this->getSurcharge()));
    }

    /**
     * Get margin
     *
     * @return integer
     */
    public function getMargin()
    {
        return round($this->getProduct()->getMargin()*100 - $this->getDiscount());
    }

    /**
     * Get marginAmount
     *
     * @return integer
     */
    public function getMarginAmount()
    {
        return round((($this->getPrice()/1.19) * ((100 - $this->getDiscount())/100)) - ($this->getProduct()->getCost()));
    }

    /**
     * Get totalMarginAmount
     *
     * @return integer
     */
    public function getTotalMarginAmount()
    {
        return round($this->getQuantity() * ((($this->getPrice()/1.19) * ((100 - $this->getDiscount())/100)) - ($this->getProduct()->getCost())));
    }

    /**
     * Get totalPrice
     *
     * @return integer
     */
    public function getTotalPrice()
    {
        // Quantity * (Price * Discount + Surcharge) * IVA
        return round(($this->getQuantity() * ((($this->getPrice()/1.19) * ((100 - $this->getDiscount())/100)) + $this->getSurcharge())) * 1.19);
    }

    /**
     * Get totalCost
     *
     * @return integer
     */
    public function getTotalCost()
    {
        return round($this->getQuantity() * $this->getProduct()->getCost());
    }

    public function setReferencePrice()
    {
        $product = $this->getProduct();

        if($product) {
            $this->setPrice( $product->getPrice() );
        }

        return $this;
    }
    /**
     * @var integer
     */
    private $surcharge;

    /**
     * Set surcharge
     *
     * @param integer $surcharge
     *
     * @return Item
     */
    public function setSurcharge($surcharge)
    {
        $this->surcharge = $surcharge;

        return $this;
    }

    /**
     * Get surcharge
     *
     * @return integer
     */
    public function getSurcharge()
    {
        return $this->surcharge;
    }
}
