<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\Jobs;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));

        for ($c = 0; $c < 5; $c++) {
            $categorie = new Categories;
            $categorie->setNom($faker->department);

            $manager->persist($categorie);

            for ($j = 0; $j < mt_rand(25, 30); $j++) {
                $job = new Jobs;
                $job->setContrat($faker->jobTitle)
                    ->setEntreprise($faker->company)
                    ->setLogo($faker->imageUrl(400, 400, true))
                    ->setUrl($faker->url)
                    ->setPays($faker->country)
                    ->setLieu($faker->city)
                    ->setDescription($faker->paragraph())
                    ->setToken($faker->unique()->word)
                    ->setEmail($faker->email)
                    ->setActive($faker->boolean())
                    ->setExpire($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setCreated($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setUpdated($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setCategory($categorie)
                    ->setPostuler($faker->paragraph());

                $manager->persist($job);
            }
        }


        $manager->flush();
    }
}
