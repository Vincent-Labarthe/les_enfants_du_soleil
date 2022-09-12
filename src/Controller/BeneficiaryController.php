<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\GeneralIdentifier;
use App\Form\AddressType;
use App\Form\SearchType;
use App\Form\BeneficiaryType;
use App\Service\BeneficiaryService;
use App\Transformer\Beneficiary\ArrayTransformer;
use App\Transformer\Beneficiary\DetailToArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Elastica\Util;
use FOS\ElasticaBundle\Finder\TransformedFinder;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/beneficiary', name: 'app_beneficiary_')]
class BeneficiaryController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(EntityManagerInterface $em, TransformedFinder $transformedFinder, Request $request): Response
    {


        $form = $this->createForm(SearchType::class);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $search = Util::escapeTerm(implode('-',$form->getData()));
           $resilut= $transformedFinder->find($search);
            dd($transformedFinder->find($search));
        }
        $data = new Collection($em->getRepository(Beneficiary::class)->findAll(), new ArrayTransformer());
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
            $formData = $form->getData();
            $newBeneficiary = $beneficiaryService->addBeneficiary($formData);
            if (!$beneficiaryService->get) {
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
        EntityManagerInterface $em,
        Beneficiary $beneficiary,
        BeneficiaryService $beneficiaryService
    ): Response {
        $form = $this->createForm(AddressType::class);
        $generalIdentifier = $em->getRepository(GeneralIdentifier::class)->findOneBy(['beneficiary' => $beneficiary]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newAddress = $form->getData();
            $beneficiaryService->addAddress($beneficiary, $newAddress);

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        return $this->render('beneficiary/add_address.html.twig', [
            'form' => $form->createView(),
            'beneficiary' => $beneficiary,
            'generalIdentifier' => $generalIdentifier,
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
            $em->flush();

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        return $this->render('beneficiary/edit.html.twig', [
            'form' => $form->createView(),
            'beneficiary' => $beneficiary,
        ]);
    }
}
