<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\Person;
use App\Entity\Address;
use App\Entity\Company;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DocumentManager');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('File Type', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('Person', 'fas fa-user', Person::class);
        // yield MenuItem::linkToCrud('Adresses', 'fas fa-list', Address::class);
        yield MenuItem::linkToCrud('Companies', 'fa fa-building-o', Company::class);
    }
}
