<?php

namespace App\Controller;


use App\Entity\Jobs;
use App\Repository\JobsRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class IndexController extends AbstractController
{
    /**
	 * JobsController constructor.
	 * @param EntityManagerInterface $em
	 */
	public function __construct(EntityManagerInterface $em) {
		$this->EntityManager = $em;
    }
    
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

    // /**
    //  * Route("/search/{recherche}" , name="search")
    //  */

    //  public function search($recherche , JobsRepository $jobsRepository, CategoriesRepository $categoriesRepository){

    //     $recherche = $categoriesRepository->findBy([
    //         'nom' => $recherche 
    //     ]);
    //     $recherche = $jobsRepository->findBy([
    //         'contrat' => $recherche ,
    //         'entreprise' => $recherche ,
    //         'pays' => $recherche ,
    //         'lieu' => $recherche 
    //     ]);

    // }

    
    /**
	 * @Route("/search/", name="search")
	 */
	public function search(CategoriesRepository $categoriesRepository):Response {
		$Request = Request::createFromGlobals();
        $query = $Request->query->get('q');

        $categories = $categoriesRepository->findAll();

		$JobsRepository = $this->EntityManager->getRepository(Jobs::class);
		$Jobs = $JobsRepository->search($query);

		return $this->render('index/search.html.twig', [
            'categs' => $categories,
			'job' => $Jobs
		]);
	}

}
