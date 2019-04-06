<?php

namespace Uni\AdminBundle\Entity;

/**
 * PortfolioTag
 */
class PortfolioTag
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
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $portfolios;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return PortfolioTag
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
     * @param \DateTime $createdAt
     *
     * @return PortfolioTag
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
     * @return PortfolioTag
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
     * @return PortfolioTag
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
     * @return PortfolioTag
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
     * Add portfolio
     *
     * @param \Uni\AdminBundle\Entity\Portfolio $portfolio
     *
     * @return PortfolioTag
     */
    public function addPortfolio(\Uni\AdminBundle\Entity\Portfolio $portfolio)
    {
        $this->portfolios[] = $portfolio;

        return $this;
    }

    /**
     * Remove portfolio
     *
     * @param \Uni\AdminBundle\Entity\Portfolio $portfolio
     */
    public function removePortfolio(\Uni\AdminBundle\Entity\Portfolio $portfolio)
    {
        $this->portfolios->removeElement($portfolio);
    }

    /**
     * Get portfolios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortfolios()
    {
        return $this->portfolios;
    }
}
