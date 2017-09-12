<?php

namespace Uni\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Issuer
 * @ORM\Entity
 * @Vich\Uploadable
 */

class Issuer
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
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="issuer_image", fileNameProperty="image")
     * @var File
     */
    private $imagefile;

    /**
     * @var string
     */
    private $rut;

    /**
     * @var string
     */
    private $address_street;

    /**
     * @var string
     */
    private $address_number;

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
     * @return Issuer
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
     * Set rut
     *
     * @param string $rut
     *
     * @return Issuer
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set addressStreet
     *
     * @param string $addressStreet
     *
     * @return Issuer
     */
    public function setAddressStreet($addressStreet)
    {
        $this->address_street = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string
     */
    public function getAddressStreet()
    {
        return $this->address_street;
    }

    /**
     * Set addressNumber
     *
     * @param string $addressNumber
     *
     * @return Issuer
     */
    public function setAddressNumber($addressNumber)
    {
        $this->address_number = $addressNumber;

        return $this;
    }

    /**
     * Get addressNumber
     *
     * @return string
     */
    public function getAddressNumber()
    {
        return $this->address_number;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Issuer
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
     * @return Issuer
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
     * @return Issuer
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $budgets;

    /**
     * @var \Uni\AdminBundle\Entity\Commune
     */
    private $commune;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->budgets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add budget
     *
     * @param \Uni\AdminBundle\Entity\Budget $budget
     *
     * @return Issuer
     */
    public function addBudget(\Uni\AdminBundle\Entity\Budget $budget)
    {
        $this->budgets[] = $budget;

        return $this;
    }

    /**
     * Remove budget
     *
     * @param \Uni\AdminBundle\Entity\Budget $budget
     */
    public function removeBudget(\Uni\AdminBundle\Entity\Budget $budget)
    {
        $this->budgets->removeElement($budget);
    }

    /**
     * Get budgets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBudgets()
    {
        return $this->budgets;
    }

    /**
     * Set commune
     *
     * @param \Uni\AdminBundle\Entity\Commune $commune
     *
     * @return Issuer
     */
    public function setCommune(\Uni\AdminBundle\Entity\Commune $commune = null)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return \Uni\AdminBundle\Entity\Commune
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Get address
     */
    public function getAddress()
    {
        $street = $this->address_street;
        $number = $this->address_number;
        $commune = $this->commune->getName();
        return $street . ' ' . $number . ', ' . $commune;
    }

    /**
     * Get region
     */
    public function getRegion()
    {
        if ($this->commune) {
            return $this->commune->getProvince()->getRegion()->getName();
        }
        return '';
    }

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;


    /**
     * Set account
     *
     * @param \Uni\AdminBundle\Entity\Account $account
     *
     * @return Issuer
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
     * Set image
     *
     * @param string $image
     *
     * @return Issuer
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
     * @return Issuer
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoices;


    /**
     * Add invoice
     *
     * @param \Uni\AdminBundle\Entity\Invoice $invoice
     *
     * @return Issuer
     */
    public function addInvoice(\Uni\AdminBundle\Entity\Invoice $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove invoice
     *
     * @param \Uni\AdminBundle\Entity\Invoice $invoice
     */
    public function removeInvoice(\Uni\AdminBundle\Entity\Invoice $invoice)
    {
        $this->invoices->removeElement($invoice);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}
