<?php

namespace App\Controller\Admin;

use App\Entity\LearningUnit;
use App\Entity\Expression;
use App\Entity\Example;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(LearningUnitCrudController::class)->generateUrl();

        return $this->redirect($url);        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Wordyapp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Learning Units', 'fas fa-list-alt', LearningUnit::class);
        yield MenuItem::linkToCrud('Expressions', 'fas fa-language', Expression::class);
        yield MenuItem::linkToCrud('Examples', 'fas fa-chalkboard', Example::class);
    }
}
