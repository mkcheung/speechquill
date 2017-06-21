<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/15/17
 * Time: 9:56 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="speech")
 */
class Speech
{

    /**
     * @ORM\Id()
     * @ORM\Column(name="speech_id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @var integer
     */
    protected $speech_id;

    /**
     * @var string
     * @ORM\Column(name="speech", type="text", nullable=false)
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
     * @var ApiUser
     * @ORM\ManyToOne(targetEntity="ApiUser", inversedBy="writtenSpeeches")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $speechWriter;


    /**
     * @ORM\OneToOne(targetEntity="Video", mappedBy="speech")
     */
    protected $video;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="speech")
     */
    protected $speechComments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->speechComments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();
    }

    /**
     * Get speechId
     *
     * @return integer
     */
    public function getSpeechId()
    {
        return $this->speech_id;
    }

    /**
     * Set speech
     *
     * @param string $speech
     *
     * @return Speech
     */
    public function setSpeech($speech)
    {
        $this->speech = $speech;

        return $this;
    }

    /**
     * Get speech
     *
     * @return string
     */
    public function getSpeech()
    {
        return $this->speech;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Speech
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
     * @return Speech
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

    /**
     * Set speechWriter
     *
     * @param \AppBundle\Entity\ApiUser $speechWriter
     *
     * @return Speech
     */
    public function setSpeechWriter(\AppBundle\Entity\ApiUser $speechWriter = null)
    {
        $this->speechWriter = $speechWriter;

        return $this;
    }

    /**
     * Get speechWriter
     *
     * @return \AppBundle\Entity\ApiUser
     */
    public function getSpeechWriter()
    {
        return $this->speechWriter;
    }

    /**
     * Add speechComment
     *
     * @param \AppBundle\Entity\Comment $speechComment
     *
     * @return Speech
     */
    public function addSpeechComment(\AppBundle\Entity\Comment $speechComment)
    {
        $this->speechComments[] = $speechComment;

        return $this;
    }

    /**
     * Remove speechComment
     *
     * @param \AppBundle\Entity\Comment $speechComment
     */
    public function removeSpeechComment(\AppBundle\Entity\Comment $speechComment)
    {
        $this->speechComments->removeElement($speechComment);
    }

    /**
     * Get speechComments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeechComments()
    {
        return $this->speechComments;
    }
}
