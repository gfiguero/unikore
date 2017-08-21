<?php

namespace Uni\AdminBundle\Entity;

/**
 * Socialmedia
 */
class Socialmedia
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $url;

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
     * @var \Uni\AdminBundle\Entity\Page
     */
    private $page;

    /**
     * @var \Uni\AdminBundle\Entity\Socialnetwork
     */
    private $socialnetwork;


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
     * Set url
     *
     * @param string $url
     *
     * @return Socialmedia
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Socialmedia
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
     * @return Socialmedia
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
     * @return Socialmedia
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
     * @return Socialmedia
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
     * @return Socialmedia
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
     * Set socialnetwork
     *
     * @param \Uni\AdminBundle\Entity\Socialnetwork $socialnetwork
     *
     * @return Socialmedia
     */
    public function setSocialnetwork(\Uni\AdminBundle\Entity\Socialnetwork $socialnetwork = null)
    {
        $this->socialnetwork = $socialnetwork;

        return $this;
    }

    /**
     * Get socialnetwork
     *
     * @return \Uni\AdminBundle\Entity\Socialnetwork
     */
    public function getSocialnetwork()
    {
        return $this->socialnetwork;
    }
}

