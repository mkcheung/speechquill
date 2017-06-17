<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/16/17
 * Time: 1:15 PM
 */

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class SpeechController extends Controller
{

    public function indexAction()
    {
        $speechServices = $this->get('app.speech_service');
        $speeches = $speechServices->getSpeeches();

        if(empty($speeches)){
            throw $this->createNotFoundException('No speeches available');
        }


        foreach($speeches as $speech){
            $data['speeches'][] = [
                'speech' => $speech->getSpeech(),
                'createdAt' => $speech->getCreatedAt(),
                'modifiedAt' => $speech->getModifiedAt()
            ];
        }

        $response = new JsonResponse($data, 200);

        return $response;
    }

    public function getSpeechAction(Request $request)
    {
        $speechServices = $this->get('app.speech_service');
        $response = $speechServices->getSpeech($request);

        if(empty($response)){
            throw $this->createNotFoundException("Speech doesn't exist.");
        }

        return $response;
    }

    public function createAction(Request $request)
    {

        $speechServices = $this->get('app.speech_service');
        $response = $speechServices->createSpeech($request);

        if(empty($response)){
            throw $this->createNotFoundException('Could not create/send message.');
        }

        return json_encode($response);
    }

}