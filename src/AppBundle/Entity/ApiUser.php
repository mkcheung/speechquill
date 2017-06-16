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
}

