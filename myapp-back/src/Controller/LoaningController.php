<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class LoaningController extends AbstractController
{
    /**
     * @Route("/loaning", name="loaning")
     */
    public function index()
    {
        return $this->render('loaning/index.html.twig', [
            'controller_name' => 'LoaningController',
        ]);
    }

    /**
     * @Route("/loaning/add", name="loaning_add")
     */
    public function index()
    {
        return $this->render('loaning/index.html.twig', [
            'controller_name' => 'LoaningController',
        ]);
    }
}
