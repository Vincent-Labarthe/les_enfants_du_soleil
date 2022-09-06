<?php

namespace App\Controller;

use App\Entity\EdsEntity;
use App\Form\EdsEntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entite-eds", name="app_eds_entity_")
 */
class EdsEntityController extends AbstractController
{
    /**
     * @Route("/creation", name="add")
     *
     * @return Response
     */
    public function add()
    {
        $form = $this->createForm(EdsEntityType::class);

        return $this->render('eds-entity/add.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="index")
     */
    public function index(EdsEntity $edsEntity)
    {
        return $this->render('eds-entity/index.html.twig', [
            'eds_entity' => $edsEntity,
        ]);
    }


}