<?php

namespace App\Controller;

use App\Entity\Person;
use App\Transformer\Person\ArrayTransformer;
use App\Transformer\Person\DetailToArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/beneficiary", name="app_beneficiary_")
 */
class BeneficiaryController extends AbstractController
{
    /**
     * @Route(name="index")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $resource = new Collection($entityManager->getRepository(Person::class)->findAll(), new ArrayTransformer());
        $manager = new Manager();
        $beneficiaries = $manager->createData($resource)->toArray();

        return $this->render('beneficiary/index.html.twig', [
            'beneficiaries' => $beneficiaries['data'],
        ]);
    }

    /**
     * @Route("/resume/{id}", name="resume", methods={"GET","POST"}, options = { "expose" = true })
     * @ParamConverter("person", class="App\Entity\Person")
     */
    public function resumeDetail(Person $person)
    {
        $resource = new Item($person, new DetailToArrayTransformer());
        $manager = new Manager();
        $beneficiarie = $manager->createData($resource)->toArray();

        return new JsonResponse($this->render('beneficiary/include/resume.html.twig', [
            'beneficiarie' => $beneficiarie['data'],
        ])->getContent());
    }

    /**
     * @Route("/{id}", name="detail", methods={"GET"})
     * @ParamConverter("person", class="App\Entity\Person")
     */
    public function detail(Person $person)
    {
        $resource = new Item($person, new DetailToArrayTransformer());
        $manager = new Manager();
        $beneficiarie = $manager->createData($resource)->toArray();

        return $this->render('beneficiary/detail.html.twig', [
            'beneficiarie' => $beneficiarie['data'],
        ]);
    }
}