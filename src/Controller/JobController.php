<?php

namespace App\Controller;

use App\Repository\JobsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobController extends AbstractController
{
    /**
     * @Route("/{categorie_nom}/{idjob}" , name="job_show")
     */

    public function show($idjob, JobsRepository $jobsRepository)
    {
        $job = $jobsRepository->findOneBy([
            'id' => $idjob
        ]);

        if (!$job) {
            throw $this->createNotFoundException("Le metier demandée n'existe pas");
        }

        return $this->render('job/index.html.twig', [
            'job' => $job
        ]);
    }
}
