<?php

namespace App\Controller;

use App\Entity\Expression;
use App\Repository\ExpressionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ExpressionController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, ExpressionRepository $expressionRepository): Response    {
        return new Response($twig->render('expression/index.html.twig', [
            'expressions' => $expressionRepository->findAll(),
            'prop1' => 'Hola',
            'prop2' => 'Mundo',
        ]));
    }    
}
