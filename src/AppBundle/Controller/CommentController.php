<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/16/17
 * Time: 12:44 PM
 */


namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class CommentController extends Controller
{

    public function indexAction()
    {
        $commentServices = $this->get('app.comment_service');
        $comments = $commentServices->getComments();

        if(empty($messages)){
            throw $this->createNotFoundException('No messages available');
        }


        foreach($comments as $comment){
            $data['comments'][] = [
                'comment' => $comment->getComment(),
                'createdAt' => $comment->getCreatedAt(),
                'modifiedAt' => $comment->getModifiedAt()
            ];
        }

        $response = new JsonResponse($data, 200);

        return $response;
    }

    public function getCommentaryForSpeechAction(Request $request)
    {
        $commentServices = $this->get('app.comment_service');
        $response = $commentServices->getSpeechCommentary($request);

        if(empty($response)){
            throw $this->createNotFoundException('No commentary for speech.');
        }

        return $response;
    }
    public function createAction(Request $request)
    {

        $commentServices = $this->get('app.comment_service');
        $response = $commentServices->createComment($request);

        if(empty($response)){
            throw $this->createNotFoundException('Could not create/send message.');
        }

        return json_encode($response);
    }

}