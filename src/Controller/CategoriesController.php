<?php

namespace App\Controller;

use App\Repository\JobsRepository;
use App\Repository\CategoriesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/cat{nom}" , name="jobs_categories")
     */
    public function cat($nom, JobsRepository $jobsRepository, CategoriesRepository $categoriesRepository, Request $request, PaginatorInterface $paginator)
    {

        $categories = $categoriesRepository->findBy([
            'nom' => $nom
        ]);

        $id = $categories[0]->getId();

        $data = $jobsRepository->findBy([
            'category' => $id,
            'active' => 1
        ]);


        $categories = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            2

        );

        if (!$categories) {
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }



        return $this->render('categories/categories.html.twig', [
            'nom' => $nom,
            'job' => $categories

        ]);
    }
}
