<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Categories;
use App\Entity\Jobs;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    /**
     * @Route("/user/job/create", name="form")
     */
    public function create(FormFactoryInterface $factory, Request $request, EntityManagerInterface $em)
    {
        $builder = $factory->createBuilder(FormType::class, null, [
            'data_class' => Jobs::class
        ]);

        $builder->add('category', EntityType::class, [
            'label' => 'Catégorie',
            'attr' => [
                'class' => 'form-control'
            ],
            'placeholder' => ' -- Choisir une catégorie --',
            'class' => Categories::class,
            'choice_label' => 'nom'
        ]);


        $builder->add('contrat', TextType::class, [
            'label' => 'Nom du Job',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Tapez le nom du Job'
            ]
        ])
            ->add('entreprise', TextType::class, [
                'label' => 'Nom de l\'entreprise',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez le nom de l\'entreprise'
                ]

            ])
            ->add('logo', TextType::class, [
                'label' => 'Logo',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez le chemin de votre logo'
                ]

            ])
            ->add('url', TextType::class, [
                'label' => 'URL',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez un URL'
                ]

            ])
            ->add('lieu', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez le nom de la ville'
                ]

            ])
            ->add('pays', TextType::class, [
                'label' => 'Pays',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez le nom du Pays'
                ]

            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Tapez votre Email'
                ]

            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description du metier'
                ]

            ]);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $product = $form->getData();
            $product->setActive(1);
            $product->setCreated(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $product->setExpire(date_add(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')), date_interval_create_from_date_string('30 days')));
            $product->setUpdated(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $product->setToken(rand(1, 10000000));
            $product->setPostuler("vi1 ché moa");

            $em->persist($product);
            $em->flush();
        }



        $formView = $form->createView();


        return $this->render('form/index.html.twig', [
            'formView' => $formView
        ]);
    }
}
