<?php

namespace App\Controller;

use App\Entity\EdsEntity;
use App\Form\EdsEntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/entite-eds', name: 'app_eds_entity_')]
class EdsEntityController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route(path: '/creation', name: 'add')]
    public function add()
    {
        $form = $this->createForm(EdsEntityType::class);

        return $this->render('eds-entity/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'index')]
    public function index(EdsEntity $edsEntity)
    {
        return $this->render('eds-entity/index.html.twig', [
            'eds_entity' => $edsEntity,
        ]);
    }
}
