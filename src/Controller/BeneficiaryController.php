<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\EdsEntity;
use App\Entity\GeneralIdentifier;
use App\Form\BeneficiaryType;
use App\Service\BeneficiaryService;
use App\Transformer\Beneficiary\DetailToArrayTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/beneficiary", name="app_beneficiary_")
 */
class BeneficiaryController extends AbstractController
{

    /**
     * @Route(name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('beneficiary/index.html.twig', [
            'controller_name' => 'BeneficiaryController',
        ]);
    }


    /**
     * Beneficiary detail page.
     *
     * @Route("/detail/{id}", name="detail")
     * @ParamConverter("beneficiary", class="App\Entity\Beneficiary")
     *
     * @param Beneficiary $beneficiary
     *
     * @return Response
     */
    public function detail(Beneficiary $beneficiary): Response
    {
        if(!$personData = new Item($beneficiary, new DetailToArrayTransformer())){
            throw $this->createNotFoundException('Person not found');
        }
        $fractal = new Manager();
        $person = $fractal->createData($personData)->toArray();

        return $this->render('beneficiary/detail.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * Beneficiary detail page.
     *
     * @Route("/add", name="add")
     **
     * @return Response
     */
    public function add(Request $request, BeneficiaryService $beneficiaryService): Response
    {
        $form = $this->createForm(BeneficiaryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $beneficiaryService->addBeneficiary($formData);

        }


            return $this->render('beneficiary/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
