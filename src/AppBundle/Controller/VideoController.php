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
//        $videoServices = $this->get('app.video_service');
//        $videos = $videoServices->getUsers();
//
//        if(empty($videos)){
//            throw $this->createNotFoundException('No videos available');
//        }
//
//
//        foreach($videos as $video){
//            $data['users'][$video->getId()] = [
//                'username' => $video->getUsername(),
//                'email' => $video->getEmail()
//            ];
//        }
//
//        $response = new JsonResponse($data, 200);
//
//        return $response;
    }

    public function createAction(Request $request)
    {

        $videoServices = $this->get('app.video_service');
        $directory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads';
        $video = $videoServices->createVideo($request,$directory);
//
//        return new Response('Video created!', 201);
    }

    public function uploadAction(Request $request)
    {
        $uploadHandler = $this->get('srio_rest_upload.upload_handler');
        $result = $uploadHandler->handleRequest($request);
        if (($response = $result->getResponse()) !== null) {
            return $response;
        }

        if (($file = $result->getFile()) !== null) {
            // Store the file path in an entity, call an API,
            // do whatever with the uploaded file here.
            return new Response();
        }

        throw new BadRequestHttpException('Unable to handle upload request');
    }

}