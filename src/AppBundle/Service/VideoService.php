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
use Misteio\CloudinaryBundle\Wrapper\CloudinaryWrapper as CloudinaryWrapper;


class VideoService
{

    private $targetDir;

    protected $em;
    protected $speechRepo;
    protected $videoRepo;
    protected $cloudinary;

    public function __construct(
        EntityManager $entityManager,
        EntityRepository $speechRepository,
        EntityRepository $videoRepository,
        CloudinaryWrapper $cloudinary,
        $targetDir
    )
    {
        $this->em = $entityManager;
        $this->speechRepo = $speechRepository;
        $this->videoRepo = $videoRepository;
        $this->cloudinary = $cloudinary;
        $this->targetDir = $targetDir;
    }


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

    public function uploadVideo(Request $request,$directory)
    {
        $speechData = json_decode($request->getContent(), true);
        $parameters = json_decode($request->request->get('request'));
        $speechAssociatedWithVideo = $this->speechRepo->findOneBy(['speech_id' => $parameters->speech_id]);

        $file = $request->files->get('file');
        $renamedFile = md5(uniqid()).'.'.$file->getClientOriginalExtension();
        $video = new Video();

        $video->setOriginalName($file->getClientOriginalName());
        $video->setMimeType($file->getClientMimeType());
        $video->setPathName($directory.$renamedFile);
        $video->setFileName($renamedFile);
        $video->setFileSize($file->getSize());
        $video->setSpeech($speechAssociatedWithVideo);

        $result = $file->move($directory,$renamedFile);
        $cloudinaryReturned = $this->cloudinary->uploadVideo($directory.'/'.$renamedFile, $renamedFile, []);
        $cloudinaryResult = $cloudinaryReturned->getResult();
        $video->setFileUrl($cloudinaryResult['url']);

        $this->em->persist($video);
        $this->em->flush();

        $data['video'][] = [
            'video_id' => $video->getVideoId(),
            'fileSize' => $video->getFileSize(),
            'fileName' => $video->getFileName(),
            'pathName' => $video->getPathName(),
            'fileUrl'  => $video->getFileUrl(),
            'created_at' => $video->getCreatedAt()
        ];
        return $data;

    }

}