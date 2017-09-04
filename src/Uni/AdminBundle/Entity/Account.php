<?php

namespace Uni\AdminBundle\Entity;

/**
 * Account
 */
class Account
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
    private $budget_note;

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
    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     *
     * @return Account
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
     * Set budgetNote
     *
     * @param string $budgetNote
     *
     * @return Account
     */
    public function setBudgetNote($budgetNote)
    {
        $this->budget_note = $budgetNote;

        return $this;
    }

    /**
     * Get budgetNote
     *
     * @return string
     */
    public function getBudgetNote()
    {
        return $this->budget_note;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @return Account
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $subcategories;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $features;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photographies;


    /**
     * Add category
     *
     * @param \Uni\AdminBundle\Entity\Category $category
     *
     * @return Account
     */
    public function addCategory(\Uni\AdminBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Uni\AdminBundle\Entity\Category $category
     */
    public function removeCategory(\Uni\AdminBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add subcategory
     *
     * @param \Uni\AdminBundle\Entity\Subcategory $subcategory
     *
     * @return Account
     */
    public function addSubcategory(\Uni\AdminBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategories[] = $subcategory;

        return $this;
    }

    /**
     * Remove subcategory
     *
     * @param \Uni\AdminBundle\Entity\Subcategory $subcategory
     */
    public function removeSubcategory(\Uni\AdminBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategories->removeElement($subcategory);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

    /**
     * Add feature
     *
     * @param \Uni\AdminBundle\Entity\Feature $feature
     *
     * @return Account
     */
    public function addFeature(\Uni\AdminBundle\Entity\Feature $feature)
    {
        $this->features[] = $feature;

        return $this;
    }

    /**
     * Remove feature
     *
     * @param \Uni\AdminBundle\Entity\Feature $feature
     */
    public function removeFeature(\Uni\AdminBundle\Entity\Feature $feature)
    {
        $this->features->removeElement($feature);
    }

    /**
     * Get features
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Add photography
     *
     * @param \Uni\AdminBundle\Entity\Photography $photography
     *
     * @return Account
     */
    public function addPhotography(\Uni\AdminBundle\Entity\Photography $photography)
    {
        $this->photographies[] = $photography;

        return $this;
    }

    /**
     * Remove photography
     *
     * @param \Uni\AdminBundle\Entity\Photography $photography
     */
    public function removePhotography(\Uni\AdminBundle\Entity\Photography $photography)
    {
        $this->photographies->removeElement($photography);
    }

    /**
     * Get photographies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotographies()
    {
        return $this->photographies;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $catalogs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $pages;


    /**
     * Add catalog
     *
     * @param \Uni\AdminBundle\Entity\Catalog $catalog
     *
     * @return Account
     */
    public function addCatalog(\Uni\AdminBundle\Entity\Catalog $catalog)
    {
        $this->catalogs[] = $catalog;

        return $this;
    }

    /**
     * Remove catalog
     *
     * @param \Uni\AdminBundle\Entity\Catalog $catalog
     */
    public function removeCatalog(\Uni\AdminBundle\Entity\Catalog $catalog)
    {
        $this->catalogs->removeElement($catalog);
    }

    /**
     * Get catalogs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatalogs()
    {
        return $this->catalogs;
    }

    /**
     * Add page
     *
     * @param \Uni\AdminBundle\Entity\Page $page
     *
     * @return Account
     */
    public function addPage(\Uni\AdminBundle\Entity\Page $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \Uni\AdminBundle\Entity\Page $page
     */
    public function removePage(\Uni\AdminBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $socialmedia;


    /**
     * Add socialmedia
     *
     * @param \Uni\AdminBundle\Entity\Socialmedia $socialmedia
     *
     * @return Account
     */
    public function addSocialmedia(\Uni\AdminBundle\Entity\Socialmedia $socialmedia)
    {
        $this->socialmedia[] = $socialmedia;

        return $this;
    }

    /**
     * Remove socialmedia
     *
     * @param \Uni\AdminBundle\Entity\Socialmedia $socialmedia
     */
    public function removeSocialmedia(\Uni\AdminBundle\Entity\Socialmedia $socialmedia)
    {
        $this->socialmedia->removeElement($socialmedia);
    }

    /**
     * Get socialmedia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSocialmedia()
    {
        return $this->socialmedia;
    }
    /**
     * @var string
     */
    private $business_name;

    /**
     * @var string
     */
    private $business_rut;

    /**
     * @var string
     */
    private $business_turn;

    /**
     * @var string
     */
    private $business_address_street;

    /**
     * @var string
     */
    private $business_address_number;

    /**
     * @var \Uni\AdminBundle\Entity\Commune
     */
    private $business_address_commune;


    /**
     * Set businessName
     *
     * @param string $businessName
     *
     * @return Account
     */
    public function setBusinessName($businessName)
    {
        $this->business_name = $businessName;

        return $this;
    }

    /**
     * Get businessName
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->business_name;
    }

    /**
     * Set businessRut
     *
     * @param string $businessRut
     *
     * @return Account
     */
    public function setBusinessRut($businessRut)
    {
        $this->business_rut = $businessRut;

        return $this;
    }

    /**
     * Get businessRut
     *
     * @return string
     */
    public function getBusinessRut()
    {
        return $this->business_rut;
    }

    /**
     * Set businessTurn
     *
     * @param string $businessTurn
     *
     * @return Account
     */
    public function setBusinessTurn($businessTurn)
    {
        $this->business_turn = $businessTurn;

        return $this;
    }

    /**
     * Get businessTurn
     *
     * @return string
     */
    public function getBusinessTurn()
    {
        return $this->business_turn;
    }

    /**
     * Set businessAddressStreet
     *
     * @param string $businessAddressStreet
     *
     * @return Account
     */
    public function setBusinessAddressStreet($businessAddressStreet)
    {
        $this->business_address_street = $businessAddressStreet;

        return $this;
    }

    /**
     * Get businessAddressStreet
     *
     * @return string
     */
    public function getBusinessAddressStreet()
    {
        return $this->business_address_street;
    }

    /**
     * Set businessAddressNumber
     *
     * @param string $businessAddressNumber
     *
     * @return Account
     */
    public function setBusinessAddressNumber($businessAddressNumber)
    {
        $this->business_address_number = $businessAddressNumber;

        return $this;
    }

    /**
     * Get businessAddressNumber
     *
     * @return string
     */
    public function getBusinessAddressNumber()
    {
        return $this->business_address_number;
    }

    /**
     * Set businessAddressCommune
     *
     * @param \Uni\AdminBundle\Entity\Commune $businessAddressCommune
     *
     * @return Account
     */
    public function setBusinessAddressCommune(\Uni\AdminBundle\Entity\Commune $businessAddressCommune = null)
    {
        $this->business_address_commune = $businessAddressCommune;

        return $this;
    }

    /**
     * Get businessAddressCommune
     *
     * @return \Uni\AdminBundle\Entity\Commune
     */
    public function getBusinessAddressCommune()
    {
        return $this->business_address_commune;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $payments;


    /**
     * Add payment
     *
     * @param \Uni\AdminBundle\Entity\AccountPayment $payment
     *
     * @return Account
     */
    public function addPayment(\Uni\AdminBundle\Entity\AccountPayment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \Uni\AdminBundle\Entity\AccountPayment $payment
     */
    public function removePayment(\Uni\AdminBundle\Entity\AccountPayment $payment)
    {
        $this->payments->removeElement($payment);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
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
     * @return Account
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
