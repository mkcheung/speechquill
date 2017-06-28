<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/17/17
 * Time: 8:58 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class VideoController extends Controller
{


    public function indexAction()
    {
        $videoServices = $this->get('app.video_service');
        $messages = $videoServices->getMessages();

        if(empty($messages)){
            throw $this->createNotFoundException('No messages available');
        }


        foreach($messages as $message){
            $data['messages'][] = [
                'message' => $message->getMessage(),
                'createdAt' => $message->getCreatedAt(),
                'modifiedAt' => $message->getModifiedAt()
            ];
        }

        $response = new JsonResponse($data, 200);

        return $response;
    }

    public function uploadAction(Request $request)
    {

        $videoServices = $this->get('app.video_service');
        $directory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
        $response = $videoServices->uploadVideo($request,$directory);

        $response = new JsonResponse($response, 200);
        return $response;
    }

}