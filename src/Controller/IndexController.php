<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\JobsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategoriesRepository $categoriesRepository, JobsRepository $jobsRepository)
    {
        $categories = $categoriesRepository->findAll();
        $jobs = $jobsRepository->findBy([
            'active' => 1
        ], [
            'created' => 'DESC',
            'category' => 'ASC'

        ], 10);

        $arrayCateg = array();
        foreach ($jobs as $job) {
            if (!in_array(array('id' => $job->getCategory()->getId(), 'nom' => $job->getCategory()->getNom()), $arrayCateg)) {
                $arrayCateg[] = array('id' => $job->getCategory()->getId(), 'nom' => $job->getCategory()->getNom());
            }
        }

        return $this->render('index/index.html.twig', [
            'categs' => $arrayCateg,
            'job' => $jobs
        ]);
    }
}
