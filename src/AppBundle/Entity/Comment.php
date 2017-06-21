<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/15/17
 * Time: 10:35 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{

    /**
     * @ORM\Id()
     * @ORM\Column(name="comment_id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @var integer
     */
    protected $comment_id;

    /**
     * @var string
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    protected $comment;

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
     * @ORM\ManyToOne(targetEntity="ApiUser", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $commentator;

    /**
     * @var Speech
     * @ORM\ManyToOne(targetEntity="Speech", inversedBy="speechComments")
     * @ORM\JoinColumn(name="speech_id", referencedColumnName="speech_id")
     */
    protected $speech;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();
    }

    /**
     * Get commentId
     *
     * @return integer
     */
    public function getCommentId()
    {
        return $this->comment_id;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Comment
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
     * @return Comment
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
     * Set commentator
     *
     * @param \AppBundle\Entity\ApiUser $commentator
     *
     * @return Comment
     */
    public function setCommentator(\AppBundle\Entity\ApiUser $commentator = null)
    {
        $this->commentator = $commentator;

        return $this;
    }

    /**
     * Get commentator
     *
     * @return \AppBundle\Entity\ApiUser
     */
    public function getCommentator()
    {
        return $this->commentator;
    }

    /**
     * Set speech
     *
     * @param \AppBundle\Entity\Speech $speech
     *
     * @return Comment
     */
    public function setSpeech(\AppBundle\Entity\Speech $speech = null)
    {
        $this->speech = $speech;

        return $this;
    }

    /**
     * Get speech
     *
     * @return \AppBundle\Entity\Speech
     */
    public function getSpeech()
    {
        return $this->speech;
    }
}
