<?php

namespace Uni\AdminBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Catalog
 */
class Catalog
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
     * @Gedmo\Slug(fields={"name"},suffix=".html")
     * @ORM\Column(length=128, unique=true, nullable=true)
     */
    private $slug;

    /**
     * @var string
     */
    private $catalog_content;

    /**
     * @var string
     */
    private $catalog_calltoaction;

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
    private $categories;

    /**
     * @var \Uni\AdminBundle\Entity\User
     */
    private $user;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->name;
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
     * @return Catalog
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Catalog
     */
    public function setSlug($slug){
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
     * Set catalogContent
     *
     * @param string $catalog_content
     *
     * @return Catalog
     */
    public function setCatalogContent($catalog_content)
    {
        $this->catalog_content = $catalog_content;

        return $this;
    }

    /**
     * Get catalogContent
     *
     * @return string
     */
    public function getCatalogContent()
    {
        return $this->catalog_content;
    }

    /**
     * Set catalogCalltoaction
     *
     * @param string $catalog_calltoaction
     *
     * @return Catalog
     */
    public function setCatalogCalltoaction($catalog_calltoaction)
    {
        $this->catalog_calltoaction = $catalog_calltoaction;

        return $this;
    }

    /**
     * Get catalogCalltoaction
     *
     * @return string
     */
    public function getCatalogCalltoaction()
    {
        return $this->catalog_calltoaction;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Catalog
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
     * @return Catalog
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
     * @return Catalog
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
     * Add category
     *
     * @param \Uni\AdminBundle\Entity\Category $category
     *
     * @return Catalog
     */
    public function addCategory(\Uni\AdminBundle\Entity\Category $category)
    {
        $category->setCatalog($this);

        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Uni\AdminBundle\Entity\Category $category
     */
    public function removeCategory(\Uni\AdminBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
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
     * @return Catalog
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
     * @var \Uni\AdminBundle\Entity\Page
     */
    private $page;


    /**
     * Set page
     *
     * @param \Uni\AdminBundle\Entity\Page $page
     *
     * @return Catalog
     */
    public function setPage(\Uni\AdminBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Uni\AdminBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }
}
