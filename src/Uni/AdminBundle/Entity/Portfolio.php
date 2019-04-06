<?php

namespace Uni\AdminBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Portfolio
 */
class Portfolio
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
    private $portfolio_content;

    /**
     * @var string
     */
    private $portfolio_calltoaction;

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
    private $portfoliocategories;

    /**
     * @var \Uni\AdminBundle\Entity\User
     */
    private $user;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * @var \Uni\AdminBundle\Entity\Page
     */
    private $page;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $portfoliotags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfoliocategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->portfoliotags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Portfolio
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
     * @return Portfolio
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
     * Set portfolioContent
     *
     * @param string $portfolioContent
     *
     * @return Portfolio
     */
    public function setPortfolioContent($portfolioContent)
    {
        $this->portfolio_content = $portfolioContent;

        return $this;
    }

    /**
     * Get portfolioContent
     *
     * @return string
     */
    public function getPortfolioContent()
    {
        return $this->portfolio_content;
    }

    /**
     * Set portfolioCalltoaction
     *
     * @param string $portfolioCalltoaction
     *
     * @return Portfolio
     */
    public function setPortfolioCalltoaction($portfolioCalltoaction)
    {
        $this->portfolio_calltoaction = $portfolioCalltoaction;

        return $this;
    }

    /**
     * Get portfolioCalltoaction
     *
     * @return string
     */
    public function getPortfolioCalltoaction()
    {
        return $this->portfolio_calltoaction;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Portfolio
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
     * @return Portfolio
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
     * @return Portfolio
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
     * Add portfoliocategory
     *
     * @param \Uni\AdminBundle\Entity\PortfolioCategory $portfoliocategory
     *
     * @return Portfolio
     */
    public function addPortfoliocategory(\Uni\AdminBundle\Entity\PortfolioCategory $portfoliocategory)
    {
        $portfoliocategory->setPortfolio($this);

        $this->portfoliocategories[] = $portfoliocategory;

        return $this;
    }

    /**
     * Remove portfoliocategory
     *
     * @param \Uni\AdminBundle\Entity\PortfolioCategory $portfoliocategory
     */
    public function removePortfoliocategory(\Uni\AdminBundle\Entity\PortfolioCategory $portfoliocategory)
    {
        $this->portfoliocategories->removeElement($portfoliocategory);
    }

    /**
     * Get portfoliocategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortfolioCategories()
    {
        return $this->portfoliocategories;
    }

    /**
     * Set user
     *
     * @param \Uni\AdminBundle\Entity\User $user
     *
     * @return Document
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
     * @return Portfolio
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
     * Set page
     *
     * @param \Uni\AdminBundle\Entity\Page $page
     *
     * @return Portfolio
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

    /**
     * Add portfoliotag
     *
     * @param \Uni\AdminBundle\Entity\PortfolioTag $portfoliotag
     *
     * @return Portfolio
     */
    public function addPortfoliotag(\Uni\AdminBundle\Entity\PortfolioTag $portfoliotag)
    {
        $this->portfoliotags[] = $portfoliotag;

        return $this;
    }

    /**
     * Remove portfoliotag
     *
     * @param \Uni\AdminBundle\Entity\PortfolioTag $portfoliotag
     */
    public function removePortfoliotag(\Uni\AdminBundle\Entity\PortfolioTag $portfoliotag)
    {
        $this->portfoliotags->removeElement($portfoliotag);
    }

    /**
     * Get portfoliotags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortfoliotags()
    {
        return $this->portfoliotags;
    }
}

