<?php

namespace Uni\AdminBundle\Entity;

/**
 * CatalogItem
 */
class CatalogItem
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
    private $surcharge;

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

    /**
     * @var \Uni\AdminBundle\Entity\Subcategory
     */
    private $subcategory;

    /**
     * @var \Uni\AdminBundle\Entity\Product
     */
    private $product;


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
     * @return CatalogItem
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
     * @return CatalogItem
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
     * Set surcharge
     *
     * @param integer $surcharge
     *
     * @return CatalogItem
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

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return CatalogItem
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CatalogItem
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
     * @return CatalogItem
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
     * @return CatalogItem
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
     * Set subcategory
     *
     * @param \Uni\AdminBundle\Entity\Subcategory $subcategory
     *
     * @return CatalogItem
     */
    public function setSubcategory(\Uni\AdminBundle\Entity\Subcategory $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \Uni\AdminBundle\Entity\Subcategory
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set product
     *
     * @param \Uni\AdminBundle\Entity\Product $product
     *
     * @return CatalogItem
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
}

