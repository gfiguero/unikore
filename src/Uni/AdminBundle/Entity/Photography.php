<?php

namespace Uni\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Evence\Bundle\SoftDeleteableExtensionBundle\Mapping\Annotation as Evence;

/**
 * Photography
 * @ORM\Entity
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="main_photography", fileNameProperty="image")
     * @var File
     */
    private $imagefile;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Uni\AdminBundle\Entity\User
     */
    private $user;

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
        if ($this->image) return $this->image; else return 'default';
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImagefile(File $image = null)
    {
        $this->imagefile = $image;

        if ($image) {
            $this->updated_at = new \DateTime();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImagefile()
    {
        return $this->imagefile;
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
    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DateTime
     */
    private $deleted_at;


    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Photography
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
     * @return Photography
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
}
