<?php

namespace Uni\AdminBundle\Entity;

/**
 * Photography
 */
class Photography
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $image;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    public function __toString()
    {
        return (string) $this->image;
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
     * Set image
     *
     * @param string $image
     *
     * @return Photography
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Photography
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
     * Set account
     *
     * @param \Uni\AdminBundle\Entity\Account $account
     *
     * @return Photography
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
     * @return Photography
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
