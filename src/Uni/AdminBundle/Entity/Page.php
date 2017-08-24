<?php

namespace Uni\AdminBundle\Entity;

/**
 * Page
 */
class Page
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
    private $features;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $photographies;

    /**
     * @var \Uni\AdminBundle\Entity\Account
     */
    private $account;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->features = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photographies = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Page
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * Add feature
     *
     * @param \Uni\AdminBundle\Entity\Feature $feature
     *
     * @return Page
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
     * @return Page
     */
    public function addPhotography(\Uni\AdminBundle\Entity\Photography $photography)
    {
        $photography->setPage($this);

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
     * Set account
     *
     * @param \Uni\AdminBundle\Entity\Account $account
     *
     * @return Page
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
    private $domain;


    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Page
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }
    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $brand_primary_color;

    /**
     * @var string
     */
    private $brand_secondary_color;

    /**
     * @var string
     */
    private $maintitle;

    /**
     * @var string
     */
    private $mainsubtitle;

    /**
     * @var string
     */
    private $maincalltoaction;

    /**
     * @var string
     */
    private $abouttitle;

    /**
     * @var string
     */
    private $aboutcontent;

    /**
     * @var string
     */
    private $featuretitle;

    /**
     * @var string
     */
    private $featurecontent;

    /**
     * @var string
     */
    private $contacttitle;

    /**
     * @var string
     */
    private $contactcontent;

    /**
     * @var string
     */
    private $contactphone;

    /**
     * @var string
     */
    private $contactemail;

    /**
     * @var string
     */
    private $contactaddress;

    /**
     * @var string
     */
    private $contactschedule;


    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Page
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set brandPrimaryColor
     *
     * @param string $brandPrimaryColor
     *
     * @return Page
     */
    public function setBrandPrimaryColor($brandPrimaryColor)
    {
        $this->brand_primary_color = $brandPrimaryColor;

        return $this;
    }

    /**
     * Get brandPrimaryColor
     *
     * @return string
     */
    public function getBrandPrimaryColor()
    {
        return $this->brand_primary_color;
    }

    /**
     * Set brandSecondaryColor
     *
     * @param string $brandSecondaryColor
     *
     * @return Page
     */
    public function setBrandSecondaryColor($brandSecondaryColor)
    {
        $this->brand_secondary_color = $brandSecondaryColor;

        return $this;
    }

    /**
     * Get brandSecondaryColor
     *
     * @return string
     */
    public function getBrandSecondaryColor()
    {
        return $this->brand_secondary_color;
    }

    /**
     * Set maintitle
     *
     * @param string $maintitle
     *
     * @return Page
     */
    public function setMaintitle($maintitle)
    {
        $this->maintitle = $maintitle;

        return $this;
    }

    /**
     * Get maintitle
     *
     * @return string
     */
    public function getMaintitle()
    {
        return $this->maintitle;
    }

    /**
     * Set mainsubtitle
     *
     * @param string $mainsubtitle
     *
     * @return Page
     */
    public function setMainsubtitle($mainsubtitle)
    {
        $this->mainsubtitle = $mainsubtitle;

        return $this;
    }

    /**
     * Get mainsubtitle
     *
     * @return string
     */
    public function getMainsubtitle()
    {
        return $this->mainsubtitle;
    }

    /**
     * Set maincalltoaction
     *
     * @param string $maincalltoaction
     *
     * @return Page
     */
    public function setMaincalltoaction($maincalltoaction)
    {
        $this->maincalltoaction = $maincalltoaction;

        return $this;
    }

    /**
     * Get maincalltoaction
     *
     * @return string
     */
    public function getMaincalltoaction()
    {
        return $this->maincalltoaction;
    }

    /**
     * Set abouttitle
     *
     * @param string $abouttitle
     *
     * @return Page
     */
    public function setAbouttitle($abouttitle)
    {
        $this->abouttitle = $abouttitle;

        return $this;
    }

    /**
     * Get abouttitle
     *
     * @return string
     */
    public function getAbouttitle()
    {
        return $this->abouttitle;
    }

    /**
     * Set aboutcontent
     *
     * @param string $aboutcontent
     *
     * @return Page
     */
    public function setAboutcontent($aboutcontent)
    {
        $this->aboutcontent = $aboutcontent;

        return $this;
    }

    /**
     * Get aboutcontent
     *
     * @return string
     */
    public function getAboutcontent()
    {
        return $this->aboutcontent;
    }

    /**
     * Set featuretitle
     *
     * @param string $featuretitle
     *
     * @return Page
     */
    public function setFeaturetitle($featuretitle)
    {
        $this->featuretitle = $featuretitle;

        return $this;
    }

    /**
     * Get featuretitle
     *
     * @return string
     */
    public function getFeaturetitle()
    {
        return $this->featuretitle;
    }

    /**
     * Set featurecontent
     *
     * @param string $featurecontent
     *
     * @return Page
     */
    public function setFeaturecontent($featurecontent)
    {
        $this->featurecontent = $featurecontent;

        return $this;
    }

    /**
     * Get featurecontent
     *
     * @return string
     */
    public function getFeaturecontent()
    {
        return $this->featurecontent;
    }

    /**
     * Set contacttitle
     *
     * @param string $contacttitle
     *
     * @return Page
     */
    public function setContacttitle($contacttitle)
    {
        $this->contacttitle = $contacttitle;

        return $this;
    }

    /**
     * Get contacttitle
     *
     * @return string
     */
    public function getContacttitle()
    {
        return $this->contacttitle;
    }

    /**
     * Set contactcontent
     *
     * @param string $contactcontent
     *
     * @return Page
     */
    public function setContactcontent($contactcontent)
    {
        $this->contactcontent = $contactcontent;

        return $this;
    }

    /**
     * Get contactcontent
     *
     * @return string
     */
    public function getContactcontent()
    {
        return $this->contactcontent;
    }

    /**
     * Set contactphone
     *
     * @param string $contactphone
     *
     * @return Page
     */
    public function setContactphone($contactphone)
    {
        $this->contactphone = $contactphone;

        return $this;
    }

    /**
     * Get contactphone
     *
     * @return string
     */
    public function getContactphone()
    {
        return $this->contactphone;
    }

    /**
     * Set contactemail
     *
     * @param string $contactemail
     *
     * @return Page
     */
    public function setContactemail($contactemail)
    {
        $this->contactemail = $contactemail;

        return $this;
    }

    /**
     * Get contactemail
     *
     * @return string
     */
    public function getContactemail()
    {
        return $this->contactemail;
    }

    /**
     * Set contactaddress
     *
     * @param string $contactaddress
     *
     * @return Page
     */
    public function setContactaddress($contactaddress)
    {
        $this->contactaddress = $contactaddress;

        return $this;
    }

    /**
     * Get contactaddress
     *
     * @return string
     */
    public function getContactaddress()
    {
        return $this->contactaddress;
    }

    /**
     * Set contactschedule
     *
     * @param string $contactschedule
     *
     * @return Page
     */
    public function setContactschedule($contactschedule)
    {
        $this->contactschedule = $contactschedule;

        return $this;
    }

    /**
     * Get contactschedule
     *
     * @return string
     */
    public function getContactschedule()
    {
        return $this->contactschedule;
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
     * @return Page
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
}
