<?php

namespace App\Controller;

use App\Entity\Loaning;
use App\Entity\Media;

use App\Form\LoaningType;
use App\Repository\LoaningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/loaning")
 */
class LoaningController extends AbstractController
{
  /**
   * @Route("/api", name="loaning_api", methods="POST")
   */
   public function api(Request $request)
   {
     $req_body = json_decode($request->getContent());
     $media_id = $req_body->media_id;
     $user = $req_body->user;

     //
     $media = $this->getDoctrine()->getRepository(Media::class)->find($media_id);


     $loaning = new Loaning($media, $user);
     $em = $this->getDoctrine()->getManager();
     $em->persist($loaning);
     $em->flush();

     return new JsonResponse($loaning->getEnd()->format('Y-m-d'));
   }

   /**
    * @Route("/history", name="loaning_history", methods="GET")
    */
    public function history(LoaningRepository $loaningRepository){
      return new JsonResponse($loaningRepository->findAllByPast());
    }
    /**
     * @Route("/", name="loaning_index", methods="GET")
     */
    public function index(LoaningRepository $loaningRepository): Response
    {
        return $this->render('loaning/index.html.twig', ['loanings' => $loaningRepository->findAll()]);
    }

    /**
     * @Route("/new", name="loaning_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $loaning = new Loaning();
        $form = $this->createForm(LoaningType::class, $loaning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loaning);
            $em->flush();

            return $this->redirectToRoute('loaning_index');
        }

        return $this->render('loaning/new.html.twig', [
            'loaning' => $loaning,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loaning_show", methods="GET")
     */
    public function show(Loaning $loaning): Response
    {
        return $this->render('loaning/show.html.twig', ['loaning' => $loaning]);
    }

    /**
     * @Route("/{id}/edit", name="loaning_edit", methods="GET|POST")
     */
    public function edit(Request $request, Loaning $loaning): Response
    {
        $form = $this->createForm(LoaningType::class, $loaning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loaning_index', ['id' => $loaning->getId()]);
        }

        return $this->render('loaning/edit.html.twig', [
            'loaning' => $loaning,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="loaning_delete", methods="DELETE")
     */
    public function delete(Request $request, Loaning $loaning): Response
    {
        if ($this->isCsrfTokenValid('delete'.$loaning->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($loaning);
            $em->flush();
        }

        return $this->redirectToRoute('loaning_index');
    }
}
