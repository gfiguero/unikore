<?php

namespace Uni\AdminBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * Group
 */
class Group extends BaseGroup
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

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
    private $issuers;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct($roles = array())
    {
        parent::__construct($roles);
        $this->issuers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->providers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sellers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->budgets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * Add issuer
     *
     * @param \Uni\AdminBundle\Entity\Issuer $issuer
     *
     * @return Group
     */
    public function addIssuer(\Uni\AdminBundle\Entity\Issuer $issuer)
    {
        $this->issuers[] = $issuer;

        return $this;
    }

    /**
     * Remove issuer
     *
     * @param \Uni\AdminBundle\Entity\Issuer $issuer
     */
    public function removeIssuer(\Uni\AdminBundle\Entity\Issuer $issuer)
    {
        $this->issuers->removeElement($issuer);
    }

    /**
     * Get issuers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssuers()
    {
        return $this->issuers;
    }

    /**
     * Add provider
     *
     * @param \Uni\AdminBundle\Entity\Provider $provider
     *
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * Add user
     *
     * @param \Uni\AdminBundle\Entity\User $user
     *
     * @return Group
     */
    public function addUser(\Uni\AdminBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Uni\AdminBundle\Entity\User $user
     */
    public function removeUser(\Uni\AdminBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
    /**
     * @var string
     */
    private $predefined_note;


    /**
     * Set predefinedNote
     *
     * @param string $predefinedNote
     *
     * @return Group
     */
    public function setPredefinedNote($predefinedNote)
    {
        $this->predefined_note = $predefinedNote;

        return $this;
    }

    /**
     * Get predefinedNote
     *
     * @return string
     */
    public function getPredefinedNote()
    {
        return $this->predefined_note;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
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
}
