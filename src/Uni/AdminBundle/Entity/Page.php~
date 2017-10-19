<?php

namespace Uni\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Evence\Bundle\SoftDeleteableExtensionBundle\Mapping\Annotation as Evence;

/**
 * Page
 * @ORM\Entity
 * @Vich\Uploadable
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
        $this->socialmedia = new \Doctrine\Common\Collections\ArrayCollection();
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
    private $main_title;

    /**
     * @var string
     */
    private $main_subtitle;

    /**
     * @var string
     */
    private $main_calltoaction;

    /**
     * @var string
     */
    private $about_title;

    /**
     * @var string
     */
    private $about_content;

    /**
     * @var string
     */
    private $feature_title;

    /**
     * @var string
     */
    private $feature_content;

    /**
     * @var string
     */
    private $cataloglinkage_title;

    /**
     * @var string
     */
    private $cataloglinkage_calltoaction;

    /**
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="brand_image", fileNameProperty="image")
     * @var File
     */
    private $imagefile;

    /**
     * @var string
     */
    private $socialmedia_title;


    /**
     * @var string
     */
    private $contact_title;

    /**
     * @var string
     */
    private $contact_content;

    /**
     * @var string
     */
    private $contact_phone;

    /**
     * @var string
     */
    private $contact_email;

    /**
     * @var string
     */
    private $contact_address;

    /**
     * @var string
     */
    private $contact_schedule;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $socialmedia;

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
     * Set mainTitle
     *
     * @param string $mainTitle
     *
     * @return Page
     */
    public function setMainTitle($mainTitle)
    {
        $this->main_title = $mainTitle;

        return $this;
    }

    /**
     * Get mainTitle
     *
     * @return string
     */
    public function getMainTitle()
    {
        return $this->main_title;
    }

    /**
     * Set mainSubtitle
     *
     * @param string $mainSubtitle
     *
     * @return Page
     */
    public function setMainSubtitle($mainSubtitle)
    {
        $this->main_subtitle = $mainSubtitle;

        return $this;
    }

    /**
     * Get mainSubtitle
     *
     * @return string
     */
    public function getMainSubtitle()
    {
        return $this->main_subtitle;
    }

    /**
     * Set mainCalltoaction
     *
     * @param string $mainCalltoaction
     *
     * @return Page
     */
    public function setMainCalltoaction($mainCalltoaction)
    {
        $this->main_calltoaction = $mainCalltoaction;

        return $this;
    }

    /**
     * Get mainCalltoaction
     *
     * @return string
     */
    public function getMainCalltoaction()
    {
        return $this->main_calltoaction;
    }

    /**
     * Set aboutTitle
     *
     * @param string $aboutTitle
     *
     * @return Page
     */
    public function setAboutTitle($aboutTitle)
    {
        $this->about_title = $aboutTitle;

        return $this;
    }

    /**
     * Get aboutTitle
     *
     * @return string
     */
    public function getAboutTitle()
    {
        return $this->about_title;
    }

    /**
     * Set aboutContent
     *
     * @param string $aboutContent
     *
     * @return Page
     */
    public function setAboutContent($aboutContent)
    {
        $this->about_content = $aboutContent;

        return $this;
    }

    /**
     * Get aboutContent
     *
     * @return string
     */
    public function getAboutContent()
    {
        return $this->about_content;
    }

    /**
     * Set featureTitle
     *
     * @param string $featureTitle
     *
     * @return Page
     */
    public function setFeatureTitle($featureTitle)
    {
        $this->feature_title = $featureTitle;

        return $this;
    }

    /**
     * Get featureTitle
     *
     * @return string
     */
    public function getFeatureTitle()
    {
        return $this->feature_title;
    }

    /**
     * Set cataloglinkageTitle
     *
     * @param string $cataloglinkageTitle
     *
     * @return Page
     */
    public function setCataloglinkageTitle($cataloglinkageTitle)
    {
        $this->cataloglinkage_title = $cataloglinkageTitle;

        return $this;
    }

    /**
     * Get cataloglinkageTitle
     *
     * @return string
     */
    public function getCataloglinkageTitle()
    {
        return $this->cataloglinkage_title;
    }

    /**
     * Set cataloglinkageCalltoaction
     *
     * @param string $cataloglinkageCalltoaction
     *
     * @return Page
     */
    public function setCataloglinkageCalltoaction($cataloglinkageCalltoaction)
    {
        $this->cataloglinkage_calltoaction = $cataloglinkageCalltoaction;

        return $this;
    }

    /**
     * Get cataloglinkageCalltoaction
     *
     * @return string
     */
    public function getCataloglinkageCalltoaction()
    {
        return $this->cataloglinkage_calltoaction;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Page
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
     * @return Page
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
     * Set socialmediaTitle
     *
     * @param string $socialmediaTitle
     *
     * @return Page
     */
    public function setSocialmediaTitle($socialmediaTitle)
    {
        $this->socialmedia_title = $socialmediaTitle;

        return $this;
    }

    /**
     * Get socialmediaTitle
     *
     * @return string
     */
    public function getSocialmediaTitle()
    {
        return $this->socialmedia_title;
    }

    /**
     * Set featureContent
     *
     * @param string $featureContent
     *
     * @return Page
     */
    public function setFeatureContent($featureContent)
    {
        $this->feature_content = $featureContent;

        return $this;
    }

    /**
     * Get featureContent
     *
     * @return string
     */
    public function getFeatureContent()
    {
        return $this->feature_content;
    }

    /**
     * Set contactTitle
     *
     * @param string $contactTitle
     *
     * @return Page
     */
    public function setContactTitle($contactTitle)
    {
        $this->contact_title = $contactTitle;

        return $this;
    }

    /**
     * Get contactTitle
     *
     * @return string
     */
    public function getContactTitle()
    {
        return $this->contact_title;
    }

    /**
     * Set contactContent
     *
     * @param string $contactContent
     *
     * @return Page
     */
    public function setContactContent($contactContent)
    {
        $this->contact_content = $contactContent;

        return $this;
    }

    /**
     * Get contactContent
     *
     * @return string
     */
    public function getContactContent()
    {
        return $this->contact_content;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return Page
     */
    public function setContactPhone($contactPhone)
    {
        $this->contact_phone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contact_phone;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Page
     */
    public function setContactEmail($contactEmail)
    {
        $this->contact_email = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * Set contactAddress
     *
     * @param string $contactAddress
     *
     * @return Page
     */
    public function setContactAddress($contactAddress)
    {
        $this->contact_address = $contactAddress;

        return $this;
    }

    /**
     * Get contactAddress
     *
     * @return string
     */
    public function getContactAddress()
    {
        return $this->contact_address;
    }

    /**
     * Set contactSchedule
     *
     * @param string $contactSchedule
     *
     * @return Page
     */
    public function setContactSchedule($contactSchedule)
    {
        $this->contact_schedule = $contactSchedule;

        return $this;
    }

    /**
     * Get contactSchedule
     *
     * @return string
     */
    public function getContactSchedule()
    {
        return $this->contact_schedule;
    }

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
