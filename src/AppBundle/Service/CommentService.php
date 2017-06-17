<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/16/17
 * Time: 12:40 AM
 */

namespace AppBundle\Service;

use AppBundle\Entity\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentService
{

    protected $em;
    protected $channelRepo;
    protected $userRepo;

    public function __construct(
        EntityManager $entityManager,
        EntityRepository $speechRepository,
        EntityRepository $commentRepository,
        EntityRepository $userRepository
    )
    {
        $this->em = $entityManager;
        $this->speechRepo = $speechRepository;
        $this->commentRepo = $commentRepository;
        $this->userRepo = $userRepository;
    }


    public function getMessages()
    {
        return $this->commentRepo->findAll();
    }

    public function createComment(Request $request)
    {

        $commentData = json_decode($request->getContent(), true);

        $comment = new Comment();

        $speechAssociatedWithComment = $this->speechRepo->findBy(['speech_id' => $commentData['speech_id']]);
        $commentator = $this->userRepo->findBy(['user_id' => $commentData['commentator_id']]);

        $comment->setCommentator($commentator);
        $comment->setSpeech($speechAssociatedWithComment);

        $this->em->persist($comment);
        $this->em->flush();
        return $comment;
    }

    public function getSpeechCommentary(Request $request)
    {

    }
}