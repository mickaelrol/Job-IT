<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\JobsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(CategoriesRepository $categoriesRepository, JobsRepository $jobsRepository): Response
    {
        $nom = $_GET['nom'];

        $categories = $categoriesRepository->findBy([
            'nom' => $nom
        ]);
        $jobs = $jobsRepository->findAll();

        $arrayContrat = array();
        $arrayEntreprise = array();
        $arrayLogo = array();
        $arrayUrl = array();
        $arrayPays = array();
        $arrayLieu = array();
        $arrayDescription = array();
        $arrayEmail = array();
        $arrayActive = array();
        $arrayExpire = array();
        $arrayCreated = array();
        $arrayUpdated = array();
        $arrayCategorie = array();
        $arrayPostuler = array();
        foreach ($jobs as $job) {
            if (!in_array($job->getCategory()->getNom(), $arrayContrat)) {
                $arrayContrat[] = $job->getContrat();
                $arrayEntreprise[] = $job->getEntreprise();
                $arrayLogo[] = $job->getLogo();
                $arrayUrl[] = $job->getUrl();
                $arrayPays[] = $job->getPays();
                $arrayLieu[] = $job->getLieu();
                $arrayDescription[] = $job->getDescription();
                $arrayEmail[] = $job->getEmail();
                $arrayActive[] = $job->getActive();
                $arrayExpire[] = $job->getExpire();
                $arrayCreated[] = $job->getCreated();
                $arrayUpdated[] = $job->getUpdated();
                $arrayCategorie[] = $job->getCategory();
                $arrayPostuler[] = $job->getPostuler();

        
            }
        }


        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
            'jobs' => $jobs
        ]);
    }
}
