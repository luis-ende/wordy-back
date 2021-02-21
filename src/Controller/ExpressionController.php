<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpressionController extends AbstractController
{
    #[Route('/expression', name: 'expression')]
    public function index(): Response
    {
        return $this->render('expression/index.html.twig', [
            'controller_name' => 'ExpressionController',
        ]);
    }
}
