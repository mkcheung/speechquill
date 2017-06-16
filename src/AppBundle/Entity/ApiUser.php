<?php

/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/15/17
 * Time: 9:43 PM
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\DateTimeType;
/**
 * @ORM\Entity
 * @ORM\Table(name="apiuser")
 */
class ApiUser extends BaseUser
{

    /**
     * @ORM\Id()
     * @ORM\Column(name="user_id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @var integer
     */
    protected $user_id;

    /**
     * @var \string
     * @ORM\Column(name="firstName", type="string", nullable=false)
     */
    protected $firstName;
    /**
     * @var \string
     * @ORM\Column(name="lastName", type="string", nullable=false)
     */
    protected $lastName;

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="commentator")
     */
    protected $comments;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Speech", mappedBy="speechWriter")
     */
    protected $writtenSpeeches;

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return ApiUser
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return ApiUser
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ApiUser
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
     * @return ApiUser
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
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return ApiUser
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add writtenSpeech
     *
     * @param \AppBundle\Entity\Speech $writtenSpeech
     *
     * @return ApiUser
     */
    public function addWrittenSpeech(\AppBundle\Entity\Speech $writtenSpeech)
    {
        $this->writtenSpeeches[] = $writtenSpeech;

        return $this;
    }

    /**
     * Remove writtenSpeech
     *
     * @param \AppBundle\Entity\Speech $writtenSpeech
     */
    public function removeWrittenSpeech(\AppBundle\Entity\Speech $writtenSpeech)
    {
        $this->writtenSpeeches->removeElement($writtenSpeech);
    }

    /**
     * Get writtenSpeeches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWrittenSpeeches()
    {
        return $this->writtenSpeeches;
    }
}
