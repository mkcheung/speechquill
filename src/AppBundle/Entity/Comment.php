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
}