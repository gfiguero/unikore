<?php

namespace Uni\AdminBundle\Entity;

/**
 * Invoice
 */
class Invoice
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
    private $code;

    /**
     * @var string
     */
    private $note;

    /**
     * @var \DateTime
     */
    private $pay_in;

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
    private $actions;

    /**
     * @var \Uni\AdminBundle\Entity\Client
     */
    private $client;

    /**
     * @var \Uni\AdminBundle\Entity\Issuer
     */
    private $issuer;

    /**
     * @var \Uni\AdminBundle\Entity\User
     */
    private $user;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Invoice
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
     * Set code
     *
     * @param string $code
     *
     * @return Invoice
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Invoice
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set payIn
     *
     * @param \DateTime $payIn
     *
     * @return Invoice
     */
    public function setPayIn($payIn)
    {
        $this->pay_in = $payIn;

        return $this;
    }

    /**
     * Get payIn
     *
     * @return \DateTime
     */
    public function getPayIn()
    {
        return $this->pay_in;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * Add action
     *
     * @param \Uni\AdminBundle\Entity\InvoiceAction $action
     *
     * @return Invoice
     */
    public function addAction(\Uni\AdminBundle\Entity\InvoiceAction $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \Uni\AdminBundle\Entity\InvoiceAction $action
     */
    public function removeAction(\Uni\AdminBundle\Entity\InvoiceAction $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set client
     *
     * @param \Uni\AdminBundle\Entity\Client $client
     *
     * @return Invoice
     */
    public function setClient(\Uni\AdminBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Uni\AdminBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set issuer
     *
     * @param \Uni\AdminBundle\Entity\Issuer $issuer
     *
     * @return Invoice
     */
    public function setIssuer(\Uni\AdminBundle\Entity\Issuer $issuer = null)
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Get issuer
     *
     * @return \Uni\AdminBundle\Entity\Issuer
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * Set user
     *
     * @param \Uni\AdminBundle\Entity\User $user
     *
     * @return Invoice
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
     * @return Invoice
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
     * @var integer
     */
    private $amount;


    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Invoice
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $shipments;


    /**
     * Add shipment
     *
     * @param \Uni\AdminBundle\Entity\Shipment $shipment
     *
     * @return Invoice
     */
    public function addShipment(\Uni\AdminBundle\Entity\Shipment $shipment)
    {
        $this->shipments[] = $shipment;

        return $this;
    }

    /**
     * Remove shipment
     *
     * @param \Uni\AdminBundle\Entity\Shipment $shipment
     */
    public function removeShipment(\Uni\AdminBundle\Entity\Shipment $shipment)
    {
        $this->shipments->removeElement($shipment);
    }

    /**
     * Get shipments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShipments()
    {
        return $this->shipments;
    }
    /**
     * @var \Uni\AdminBundle\Entity\Order
     */
    private $order;


    /**
     * Set order
     *
     * @param \Uni\AdminBundle\Entity\Order $order
     *
     * @return Invoice
     */
    public function setOrder(\Uni\AdminBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Uni\AdminBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * @var string
     */
    private $number;


    /**
     * Set number
     *
     * @param string $number
     *
     * @return Invoice
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
    /**
     * @var \Uni\AdminBundle\Entity\PaymentStatus
     */
    private $paymentstatus;


    /**
     * Set paymentstatus
     *
     * @param \Uni\AdminBundle\Entity\PaymentStatus $paymentstatus
     *
     * @return Invoice
     */
    public function setPaymentstatus(\Uni\AdminBundle\Entity\PaymentStatus $paymentstatus = null)
    {
        $this->paymentstatus = $paymentstatus;

        return $this;
    }

    /**
     * Get paymentstatus
     *
     * @return \Uni\AdminBundle\Entity\PaymentStatus
     */
    public function getPaymentstatus()
    {
        return $this->paymentstatus;
    }
}
