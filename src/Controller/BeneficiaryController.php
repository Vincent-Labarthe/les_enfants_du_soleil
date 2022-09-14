<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\BeneficiaryEdsEntity;
use App\Entity\Employee;
use App\Entity\GeneralIdentifier;
use App\Form\AddressType;
use App\Form\BeneficiarySearchType;
use App\Form\BeneficiaryType;
use App\Service\BeneficiaryService;
use App\Transformer\Beneficiary\ArrayTransformer;
use App\Transformer\Beneficiary\DetailToArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/beneficiary', name: 'app_beneficiary_')]
class BeneficiaryController extends AbstractController
{
    /**
     * Beneficiary list & search.
     *
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @return Response
     */
    #[Route(name: 'index')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(BeneficiarySearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaries = $em->getRepository(Beneficiary::class)->search($form->getData());
        }

        if (!isset($beneficiaries)) {
            $beneficiaries = $em->getRepository(Beneficiary::class)->findAll();
        }

        $data = new Collection($beneficiaries, new ArrayTransformer());
        $fractal = new Manager();

        return $this->render('beneficiary/index.html.twig', [
            'beneficiaries' => $fractal->createData($data)->toArray()['data'],
            'form' => $form->createView()
        ]);
    }

    /**
     * Beneficiary detail page.
     *
     * @ParamConverter("beneficiary", class="App\Entity\Beneficiary")
     */
    #[Route(path: '/detail/{id}', name: 'detail')]
    public function detail(EntityManagerInterface $em, Beneficiary $beneficiary): Response
    {
        if (!$personData = new Item($beneficiary, new DetailToArrayTransformer())) {
            throw $this->createNotFoundException('Person not found');
        }
        $fractal = new Manager();
        $beneficiaryArray = $fractal->createData($personData)->toArray();
        $generalIdentifier = $em->getRepository(GeneralIdentifier::class)->findOneBy(['beneficiary' => $beneficiary]);

        return $this->render('beneficiary/detail.html.twig', [
            'person' => $beneficiaryArray,
            'generalIdentifier' => $generalIdentifier,
        ]);
    }

    /**
     * Beneficiary add page.
     */
    #[Route(path: '/add', name: 'add')]
    public function add(Request $request, BeneficiaryService $beneficiaryService): Response
    {
        $form = $this->createForm(BeneficiaryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newBeneficiary = $beneficiaryService->addBeneficiary($form->getData());
            if (!$newBeneficiary->getEdsEntity()) {
                return $this->redirectToRoute('app_beneficiary_add_address', ['id' => $newBeneficiary->getId()]);
            }

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $newBeneficiary->getId()]);
        }

        return $this->render('beneficiary/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Beneficiary address add page.
     */
    #[Route(path: '/add/address/{id}', name: 'add_address')]
    public function addAddress(
        Request $request,
        Beneficiary $beneficiary,
        BeneficiaryService $beneficiaryService
    ): Response {
        $form = $this->createForm(AddressType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newAddress = $form->getData();
            $beneficiaryService->addAddress($beneficiary, $newAddress);

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        return $this->render('beneficiary/add_address.html.twig', [
            'form' => $form->createView(),
            'beneficiary' => $beneficiary,
        ]);
    }

    /**
     * Beneficiary edit page.
     */
    #[Route(path: '/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(EntityManagerInterface $em, Request $request, Beneficiary $beneficiary): Response
    {
        $form = $this->createForm(BeneficiaryType::class, $beneficiary);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $localisationHistory = $form->getData()->getEdsEntity()->toArray();
            foreach ($localisationHistory as $localisation) {
                if ($localisation->getEndedAt() === null){
                    if ($localisation->getEdsEntity() !== $form->get('edsEntity')->getData()) {
                        $localisation->setEndedAt(new \DateTime());
                        $newLocalisation = new BeneficiaryEdsEntity();
                        $newLocalisation->setBeneficiary($beneficiary);
                        $newLocalisation->setEdsEntity($form->get('edsEntity')->getData());
                        $newLocalisation->setStartedAt(new \DateTime());
                        $em->persist($newLocalisation);
                        break;
                    }
                }
            }

            $em->flush();

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        return $this->render('beneficiary/edit.html.twig', [
            'form' => $form->createView(),
            'beneficiary' => $beneficiary,
        ]);
    }

    #[Route(path: '/localisation/ajax', name: 'localisation_ajax', options: ['expose' => true], methods: ['POST'])]
    public function localisationAjax(Request $request, EntityManagerInterface $em)
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->request->get('id'));
        $localisation = $beneficiary?->getEdsEntity()->toArray();

        $html = $this->render('beneficiary/_include/_localisation.html.twig', [
            'localisations' => $localisation,
        ]);

        return new JsonResponse($html->getContent());
    }
}
