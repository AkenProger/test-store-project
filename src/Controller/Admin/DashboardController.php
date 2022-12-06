<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Manufacturer;
use App\Entity\Product;
use App\Entity\ProductImages;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(CategoriesCrudController::class)->generateUrl();

        return $this->redirect($url);
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TEST STORE');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Главная страница', 'fas fa-home', 'app_main');
        yield MenuItem::linkToCrud('Категории', 'fas fa-map-marker-alt', Categories::class);
        yield MenuItem::linkToCrud('Производители', 'fas fa-comments', Manufacturer::class);
        yield MenuItem::linkToCrud('Продукции', 'fas fa-comments', Product::class);
        yield MenuItem::linkToCrud('Фотографии продуктов', 'fas fa-comments', ProductImages::class);
        yield MenuItem::linkToCrud('Пользователи', 'fas fa-comments', User::class);
    }
}
