<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/17/17
 * Time: 5:29 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\Column(name="video_id", type = "integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    public $video_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $originalName;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    public $mimeType;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $pathName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    public $fileName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $fileUrl;

    /**
     * @ORM\Column(type="bigint", nullable=false)
     */
    public $fileSize;

    /**
     * @ORM\OneToOne(targetEntity="Speech", inversedBy="video")
     * @ORM\JoinColumn(name="speech_id", referencedColumnName="speech_id")
     */
    protected $speech;

    /**
     * @var \DateTime
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="modifiedAt", type="datetime", nullable=false)
     */
    protected $modifiedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();
    }

    /**
     * Get videoId
     *
     * @return integer
     */
    public function getVideoId()
    {
        return $this->video_id;
    }

    public function getOriginalName()
    {
        return  $this->originalName;
    }

    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;
    }

    public function getMimeType()
    {
        return  $this->mimeType;
    }

    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    public function getFileName()
    {
        return  $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getFileSize()
    {
        return  $this->fileSize;
    }

    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    public function getFileUrl()
    {
        return  $this->fileUrl;
    }

    public function setFileUrl($fileUrl)
    {
        $this->fileUrl = $fileUrl;
    }

    public function getPathName()
    {
        return $this->pathName;
    }

    public function setPathName($pathName)
    {
        $this->pathName = $pathName;
    }

    public function getSpeech()
    {
        return $this->speech;
    }

    public function setSpeech($speech)
    {
        $this->speech = $speech;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Video
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return Video
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

}