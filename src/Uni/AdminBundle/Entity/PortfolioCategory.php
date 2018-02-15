<?php

namespace Uni\AdminBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * PortfolioCategory
 */
class PortfolioCategory
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
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * @var \Uni\AdminBundle\Entity\Portfolio
     */
    private $portfolio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $portfolioitems;


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
     * @return PortfolioCategory
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

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return PortfolioCategory
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
     * @return PortfolioCategory
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
     * Set account
     *
     * @param \Uni\AdminBundle\Entity\Account $account
     *
     * @return PortfolioCategory
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
     * Set portfolio
     *
     * @param \Uni\AdminBundle\Entity\Portfolio $portfolio
     *
     * @return PortfolioCategory
     */
    public function setPortfolio(\Uni\AdminBundle\Entity\Portfolio $portfolio = null)
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    /**
     * Get portfolio
     *
     * @return \Uni\AdminBundle\Entity\Portfolio
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }

    /**
     * Add portfolioitem
     *
     * @param \Uni\AdminBundle\Entity\PortfolioItem $portfolioitem
     *
     * @return PortfolioCategory
     */
    public function addPortfolioitem(\Uni\AdminBundle\Entity\PortfolioItem $portfolioitem)
    {
        $this->portfolioitems[] = $portfolioitem;

        return $this;
    }

    /**
     * Remove portfolioitem
     *
     * @param \Uni\AdminBundle\Entity\PortfolioItem $portfolioitem
     */
    public function removePortfolioitem(\Uni\AdminBundle\Entity\PortfolioItem $portfolioitem)
    {
        $this->portfolioitems->removeElement($portfolioitem);
    }

    /**
     * Get portfolioitems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortfolioitems()
    {
        return $this->portfolioitems;
    }
}
