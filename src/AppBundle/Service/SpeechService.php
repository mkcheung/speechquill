<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/16/17
 * Time: 11:46 AM
 */

namespace AppBundle\Service;

use AppBundle\Entity\Speech;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SpeechService
{

    protected $em;
    protected $channelRepo;
    protected $userRepo;

    public function __construct(
        EntityManager $entityManager,
        EntityRepository $userRepository
    ) {
        $this->em       = $entityManager;
        $this->userRepo = $userRepository;
    }

    public function createSpeech(Request $request)
    {

        $speechData = json_decode($request->getContent(), true);

        $speech = new Speech();

        $speechWriter = $this->userRepo->findOneBy(['user_id' => $speechData['user_id']]);

        $speech->setSpeechWriter($speechWriter);
        $speech->setSpeech($speechData['speech']);

        $this->em->persist($speech);
        $this->em->flush();

        $data['speech'][] = [
            'speech_id' => $speech->getSpeechId(),
            'speechwriter' => $speechWriter->getFirstName().' '.$speechWriter->getLastName(),
            'speech' => $speech->getSpeech(),
            'created_at' => $speech->getCreatedAt()
        ];
        return $data;
    }
}