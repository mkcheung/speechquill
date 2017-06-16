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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="speech")
     */
    protected $speechComments;
}