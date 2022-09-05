<?php

namespace App\Controller;

use App\Entity\EdsEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entite-eds", name="app_eds_entity_")
 */
class EdsEntityController extends AbstractController
{
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