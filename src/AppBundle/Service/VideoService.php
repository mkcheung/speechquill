<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 6/17/17
 * Time: 8:51 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\Video;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class VideoService
{

    private $targetDir;

    protected $em;
    protected $speechRepo;

    public function __construct(
        EntityManager $entityManager,
        EntityRepository $speechRepository,
        EntityRepository $videoRepository,
        $targetDir
    )
    {
        $this->em = $entityManager;
        $this->speechRepo = $speechRepository;
        $this->videoRepo = $videoRepository;
        $this->targetDir = $targetDir;
    }

//    public function __construct($targetDir)
//    {
//
//    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

    public function getVideos()
    {
        return $this->videoRepo->findAll();
    }

    public function createVideo(Request $request,$directory)
    {
//var_dump(ini_get("upload_max_filesize"));die;
//        var_dump($request);die;
        $file = $request->files->get('file');
        $res = $file->move($directory,'video.'.$file->getClientOriginalExtension());
//        var_dump($file);die;
//        $videoData = json_decode($request->getContent(), true);
//var_dump($videoData);die;
//        $video = new Video();
//
//        $video->setName($videoData['username']);
//        $this->em->persist($video);
//        $this->em->flush();
//        return $video;
    }

}