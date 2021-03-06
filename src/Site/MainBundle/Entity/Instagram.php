<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Page
 *
 * @ORM\Table(name="instagram")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\InstagramRepository")
 */
class Instagram
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="low_image_url", type="string", length=255, nullable=false)
     */
    private $lowImageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="standard_image_url", type="string", length=255, nullable=false)
     */
    private $standardImageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail_url", type="string", length=255, nullable=false)
     */
    private $thumbnailUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="caption_text", type="text", nullable=true)
     */
    private $captionText;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="boolean", nullable=true)
     */
    private $type = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="created_time", type="datetime", nullable=true)
     */
    private $createdTime = 0;

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
     * Set lowImageUrl
     *
     * @param string $lowImageUrl
     * @return Instagram
     */
    public function setLowImageUrl($lowImageUrl)
    {
        $this->lowImageUrl = $lowImageUrl;

        return $this;
    }

    /**
     * Get lowImageUrl
     *
     * @return string 
     */
    public function getLowImageUrl()
    {
        return $this->lowImageUrl;
    }

    /**
     * Set standardImageUrl
     *
     * @param string $standardImageUrl
     * @return Instagram
     */
    public function setStandardImageUrl($standardImageUrl)
    {
        $this->standardImageUrl = $standardImageUrl;

        return $this;
    }

    /**
     * Get standardImageUrl
     *
     * @return string 
     */
    public function getStandardImageUrl()
    {
        return $this->standardImageUrl;
    }

    /**
     * Set thumbnailUrl
     *
     * @param string $thumbnailUrl
     * @return Instagram
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Get thumbnailUrl
     *
     * @return string 
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * Set captionText
     *
     * @param string $captionText
     * @return Instagram
     */
    public function setCaptionText($captionText)
    {
        $this->captionText = $captionText;

        return $this;
    }

    /**
     * Get captionText
     *
     * @return string 
     */
    public function getCaptionText()
    {
        return $this->captionText;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Instagram
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Instagram
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     * @return Instagram
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime 
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }
}
