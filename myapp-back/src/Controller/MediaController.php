<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Media;
use App\Form\MediaType;



class MediaController extends AbstractController
{
    /**
     * @Route("/media", name="media")
     */
    public function index()
    {
      $medias= $this->getDoctrine()->getRepository(Media::class)->findAll();
        return $this->render('media/index.html.twig', [
            'medias' => $medias,
        ]);
    }

    /**
     * @Route("/media/add", name="media_add")
     */
    public function add(Request $request)
    {
        $media = new Media();
        $form= $this->createForm(MediaType::class,$media);
        $form->handleRequest($request);
        if($form->isSubmitted()){
          $media=$form->getData();
          $em=$this->getDoctrine()->getManager();
          $em->persist($media);
          $em->flush();
        }
        return $this->render('media/add.html.twig', array(
          'form'=>$form->createView()
        ));
    }
    /**
     * @Route("/media/json", name="media_json")
     */
    public function index_json()
    {
      $medias= $this->getDoctrine()->getRepository(Media::class)->findByAssoc();
        return new JsonResponse($medias);
    }

}
