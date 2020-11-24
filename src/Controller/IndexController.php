<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\JobsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategoriesRepository $categoriesRepository, JobsRepository $jobsRepository)
    {
        $categories = $categoriesRepository->findAll();
        $job = $jobsRepository->findBy([],[
            'category' => 'ASC',
            'created' => 'ASC'
        ], 10);

        /*
            for job in jobs:
                if last != job.categorie_id:
                    show_categorie(categorie[job.categorie_id])
                    last = job.categorie_id;
                endif;
                show(job);
            endfor;
        */

        return $this->render('index/index.html.twig', [
            'category' => $categories,
            'job' => $job
        ]);
    }
}
