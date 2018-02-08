<?php

namespace Uni\AdminBundle\Entity;

/**
 * PortfolioItem
 */
class PortfolioItem
{
    /**
     * @var integer
     */
    private $id;

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
     * @var \Uni\AdminBundle\Entity\User
     */
    private $user;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * @var \Uni\AdminBundle\Entity\PortfolioCategory
     */
    private $portfoliocategory;

    /**
     * @var \Uni\AdminBundle\Entity\Document
     */
    private $document;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * Set user
     *
     * @param \Uni\AdminBundle\Entity\User $user
     *
     * @return PortfolioItem
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
     * @return PortfolioItem
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
     * Set portfoliocategory
     *
     * @param \Uni\AdminBundle\Entity\PortfolioCategory $portfoliocategory
     *
     * @return PortfolioItem
     */
    public function setPortfoliocategory(\Uni\AdminBundle\Entity\PortfolioCategory $portfoliocategory = null)
    {
        $this->portfoliocategory = $portfoliocategory;

        return $this;
    }

    /**
     * Get portfoliocategory
     *
     * @return \Uni\AdminBundle\Entity\PortfolioCategory
     */
    public function getPortfoliocategory()
    {
        return $this->portfoliocategory;
    }

    /**
     * Set document
     *
     * @param \Uni\AdminBundle\Entity\Document $document
     *
     * @return PortfolioItem
     */
    public function setDocument(\Uni\AdminBundle\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \Uni\AdminBundle\Entity\Document
     */
    public function getDocument()
    {
        return $this->document;
    }
}

