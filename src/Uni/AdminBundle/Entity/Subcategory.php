<?php

namespace Uni\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evence\Bundle\SoftDeleteableExtensionBundle\Mapping\Annotation as Evence;

/**
 * Subcategory
 */
class Subcategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * @var \Uni\AdminBundle\Entity\User
     */
    private $user;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * @var \Uni\AdminBundle\Entity\Category
     * @ORM\ManyToOne(targetEntity="Uni\AdminBundle\Entity\Category")
     * @Evence\onSoftDelete(type="SET NULL")
     */
    private $category;

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Subcategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $created_at
     *
     * @return Subcategory
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

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
     * @param \DateTime $updated_at
     *
     * @return Subcategory
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

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
     * @param \DateTime $deleted_at
     *
     * @return Subcategory
     */
    public function setDeletedAt($deleted_at)
    {
        $this->deleted_at = $deleted_at;

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
     * Add product
     *
     * @param \Uni\AdminBundle\Entity\Product $product
     *
     * @return Subcategory
     */
    public function addProduct(\Uni\AdminBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Uni\AdminBundle\Entity\Product $product
     */
    public function removeProduct(\Uni\AdminBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set user
     *
     * @param \Uni\AdminBundle\Entity\User $user
     *
     * @return Product
     */
    public function setUser(\Uni\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Uni\AdminBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set account
     *
     * @param \Uni\AdminBundle\Entity\Account $account
     *
     * @return Subcategory
     */
    public function setAccount(\Uni\AdminBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Uni\AdminBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set category
     *
     * @param \Uni\AdminBundle\Entity\Category $category
     *
     * @return Subcategory
     */
    public function setCategory(\Uni\AdminBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Uni\AdminBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Subcategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $catalogitems;


    /**
     * Add catalogitem
     *
     * @param \Uni\AdminBundle\Entity\CatalogItem $catalogitem
     *
     * @return Subcategory
     */
    public function addCatalogitem(\Uni\AdminBundle\Entity\CatalogItem $catalogitem)
    {
        $this->catalogitems[] = $catalogitem;

        return $this;
    }

    /**
     * Remove catalogitem
     *
     * @param \Uni\AdminBundle\Entity\CatalogItem $catalogitem
     */
    public function removeCatalogitem(\Uni\AdminBundle\Entity\CatalogItem $catalogitem)
    {
        $this->catalogitems->removeElement($catalogitem);
    }

    /**
     * Get catalogitems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatalogitems()
    {
        return $this->catalogitems;
    }
}
