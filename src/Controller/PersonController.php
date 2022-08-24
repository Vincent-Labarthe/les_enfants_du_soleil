<?php

namespace App\Controller;

use App\Entity\Person;
use App\Transformer\Person\DetailToArrayTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/person", name="app_person_")
 */
class PersonController extends AbstractController
{
    /**
     * Person detail page.
     *
     * @Route("/detail/{id}", name="detail")
     * @ParamConverter("person", class="App\Entity\Person")
     *
     * @param Person $person Person entity
     *
     * @return Response
     */
    public function detail(Person $person): Response
    {
        $personData = new Item($person, new DetailToArrayTransformer());
        $fractal = new Manager();
        $person = $fractal->createData($personData)->toArray();

        return $this->render('person/detail.html.twig', [
            'person' => $person,
        ]);
    }
}
