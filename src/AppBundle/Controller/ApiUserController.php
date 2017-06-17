<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/16/17
 * Time: 1:25 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class ApiUserController extends Controller
{

    public function indexAction()
    {
        $userServices = $this->get('app.user_service');
        $users = $userServices->getUsers();

        if(empty($users)){
            throw $this->createNotFoundException('No users available');
        }


        foreach($users as $user){
            $data['users'][$user->getId()] = [
                'username' => $user->getUsername(),
                'email' => $user->getEmail()
            ];
        }

        $response = new JsonResponse($data, 200);

        return $response;
    }

    public function createAction(Request $request)
    {

        $userServices = $this->get('app.user_service');
        $user = $userServices->createUser($request);

        return new Response('User created!', 201);
    }

}