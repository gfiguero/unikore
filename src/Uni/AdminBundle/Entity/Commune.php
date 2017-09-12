<?php

namespace Uni\AdminBundle\Entity;

/**
 * Commune
 */
class Commune
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
     * @var \Uni\AdminBundle\Entity\Province
     */
    private $province;

    public function __toString()
    {
        return (string) $this->name;
    }

    public function getFullName()
    {
        return (string) $this->name . ', ' . $this->getProvince() . ', ' . $this->getProvince()->getRegion() . '.';
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
     * @return Commune
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
     * Set province
     *
     * @param \Uni\AdminBundle\Entity\Province $province
     *
     * @return Commune
     */
    public function setProvince(\Uni\AdminBundle\Entity\Province $province = null)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return \Uni\AdminBundle\Entity\Province
     */
    public function getProvince()
    {
        return $this->province;
    }
}
