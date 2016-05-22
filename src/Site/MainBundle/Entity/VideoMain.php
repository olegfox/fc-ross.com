<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\VideoMain
 *
 * @ORM\Table(name="video_main")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\VideoMainRepository")
 */
class VideoMain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="text", nullable=false)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $preview;

    /**
     * @Assert\File()
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="html", type="text", nullable=false)
     */
    private $html;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $preview_image_url = "";

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $main;

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
     * Set title
     *
     * @param string $title
     * @return VideoMain
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return VideoMain
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
     * Set html
     *
     * @param string $html
     * @return VideoMain
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set preview_image_url
     *
     * @param string $previewImageUrl
     * @return VideoMain
     */
    public function setPreviewImageUrl($previewImageUrl)
    {
        $this->preview_image_url = $previewImageUrl;

        return $this;
    }

    /**
     * Get preview_image_url
     *
     * @return string 
     */
    public function getPreviewImageUrl()
    {
        return $this->preview_image_url;
    }

    /**
     * Set main
     *
     * @param boolean $main
     * @return VideoMain
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean 
     */
    public function getMain()
    {
        return $this->main;
    }

    public function getAbsolutePath()
    {
        return null === $this->preview
            ? null
            : $this->getUploadRootDir().'/'.$this->preview;
    }

    public function getWebPath()
    {
        return null === $this->preview
            ? null
            : $this->getUploadDir().'/'.$this->preview;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/videomain';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        $this->upload();
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        if (isset($this->preview)) {
            if(file_exists($this->getUploadDir().'/'.$this->preview)){
                unlink($this->getUploadDir().'/'.$this->preview);
            }
            $this->preview = null;
        }

        $this->preview = $this->getFile()->getClientOriginalName();

        $this->getFile()->move(
            $this->getUploadDir(),
            $this->preview
        );

        $this->file = null;
    }

    /**
     * Set preview
     *
     * @param string $preview
     * @return VideoMain
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get preview
     *
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }
}
