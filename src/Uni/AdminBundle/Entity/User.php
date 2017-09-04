<?php

namespace Uni\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

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
    private $providers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sellers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $clients;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $budgets;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $notes;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->providers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sellers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->budgets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Add provider
     *
     * @param \Uni\AdminBundle\Entity\Provider $provider
     *
     * @return User
     */
    public function addProvider(\Uni\AdminBundle\Entity\Provider $provider)
    {
        $this->providers[] = $provider;

        return $this;
    }

    /**
     * Remove provider
     *
     * @param \Uni\AdminBundle\Entity\Provider $provider
     */
    public function removeProvider(\Uni\AdminBundle\Entity\Provider $provider)
    {
        $this->providers->removeElement($provider);
    }

    /**
     * Get providers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Add seller
     *
     * @param \Uni\AdminBundle\Entity\Seller $seller
     *
     * @return User
     */
    public function addSeller(\Uni\AdminBundle\Entity\Seller $seller)
    {
        $this->sellers[] = $seller;

        return $this;
    }

    /**
     * Remove seller
     *
     * @param \Uni\AdminBundle\Entity\Seller $seller
     */
    public function removeSeller(\Uni\AdminBundle\Entity\Seller $seller)
    {
        $this->sellers->removeElement($seller);
    }

    /**
     * Get sellers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSellers()
    {
        return $this->sellers;
    }

    /**
     * Add client
     *
     * @param \Uni\AdminBundle\Entity\Client $client
     *
     * @return User
     */
    public function addClient(\Uni\AdminBundle\Entity\Client $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \Uni\AdminBundle\Entity\Client $client
     */
    public function removeClient(\Uni\AdminBundle\Entity\Client $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add budget
     *
     * @param \Uni\AdminBundle\Entity\Budget $budget
     *
     * @return User
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
     * Add product
     *
     * @param \Uni\AdminBundle\Entity\Product $product
     *
     * @return User
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
     * Add note
     *
     * @param \Uni\AdminBundle\Entity\Note $note
     *
     * @return User
     */
    public function addNote(\Uni\AdminBundle\Entity\Note $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \Uni\AdminBundle\Entity\Note $note
     */
    public function removeNote(\Uni\AdminBundle\Entity\Note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }
    /**
     * @var \Uni\AdminBundle\Entity\Group
     */
    private $group;


    /**
     * Set group
     *
     * @param \Uni\AdminBundle\Entity\Group $group
     *
     * @return User
     */
    public function setGroup(\Uni\AdminBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Uni\AdminBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * @var string
     */
    private $name;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;


    /**
     * Set account
     *
     * @param \Uni\AdminBundle\Entity\Account $account
     *
     * @return User
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
     * @var string
     */
    private $phone_number;

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
     * @var \Uni\AdminBundle\Entity\Commune
     */
    private $address_commune;


    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Set rut
     *
     * @param string $rut
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set addressCommune
     *
     * @param \Uni\AdminBundle\Entity\Commune $addressCommune
     *
     * @return User
     */
    public function setAddressCommune(\Uni\AdminBundle\Entity\Commune $addressCommune = null)
    {
        $this->address_commune = $addressCommune;

        return $this;
    }

    /**
     * Get addressCommune
     *
     * @return \Uni\AdminBundle\Entity\Commune
     */
    public function getAddressCommune()
    {
        return $this->address_commune;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoices;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $invoiceactions;


    /**
     * Add invoice
     *
     * @param \Uni\AdminBundle\Entity\Invoice $invoice
     *
     * @return User
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

    /**
     * Add invoiceaction
     *
     * @param \Uni\AdminBundle\Entity\InvoiceAction $invoiceaction
     *
     * @return User
     */
    public function addInvoiceaction(\Uni\AdminBundle\Entity\InvoiceAction $invoiceaction)
    {
        $this->invoiceactions[] = $invoiceaction;

        return $this;
    }

    /**
     * Remove invoiceaction
     *
     * @param \Uni\AdminBundle\Entity\InvoiceAction $invoiceaction
     */
    public function removeInvoiceaction(\Uni\AdminBundle\Entity\InvoiceAction $invoiceaction)
    {
        $this->invoiceactions->removeElement($invoiceaction);
    }

    /**
     * Get invoiceactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoiceactions()
    {
        return $this->invoiceactions;
    }
}
