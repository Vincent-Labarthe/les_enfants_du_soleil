<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\BehaviorEvent;
use App\Entity\Beneficiary;
use App\Entity\BeneficiaryEdsEntity;
use App\Entity\FamilyRelation;
use App\Entity\GeneralIdentifier;
use App\Entity\HealthEvent;
use App\Entity\InterviewReport;
use App\Form\AddressType;
use App\Form\BehaviourEventType;
use App\Form\BeneficiaryFormationType;
use App\Form\BeneficiaryLocalisationType;
use App\Form\BeneficiarySearchType;
use App\Form\BeneficiaryType;
use App\Form\FamilyType;
use App\Form\HealthEventType;
use App\Form\InterviewType;
use App\Service\BeneficiaryService;
use App\Service\EdsEntityService;
use App\Transformer\Beneficiary\ArrayTransformer;
use App\Transformer\Beneficiary\DetailToArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/beneficiary', name: 'app_beneficiary_')]
class BeneficiaryController extends AbstractController
{
    /**
     * Beneficiary list & search.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return Response
     */
    #[Route(name: 'index')]
    public function index(EntityManagerInterface $em, Request $request, EdsEntityService $edsEntityService): Response
    {
        $form = $this->createForm(BeneficiarySearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaries = $em->getRepository(Beneficiary::class)->search($form->getData());
        }

        if (!isset($beneficiaries)) {
            $beneficiaries = $em->getRepository(Beneficiary::class)->findBy([], ['id' => 'DESC']);
        }

        $data = new Collection($beneficiaries, new ArrayTransformer());
        $fractal = new Manager();

        return $this->render('beneficiary/index.html.twig', [
            'beneficiaries' => $fractal->createData($data)->toArray()['data'],
            'form' => $form->createView(),
            'parentEdsEntities' => $edsEntityService->getParentEdsEntity(),
        ]);
    }

    /**
     * Beneficiary detail page.
     *
     * @ParamConverter("beneficiary", class="App\Entity\Beneficiary")
     *
     * @param EntityManagerInterface $em          The entity manager
     * @param Request                $request     Current request
     * @param Beneficiary            $beneficiary Current beneficiary
     *
     * @return Response
     */
    #[Route(path: '/detail/{id}', name: 'detail', options: ['expose' => true])]
    public function detail(EntityManagerInterface $em, Request $request, Beneficiary $beneficiary): Response
    {
        if (!$personData = new Item($beneficiary, new DetailToArrayTransformer())) {
            throw $this->createNotFoundException('Person not found');
        }
        $fractal = new Manager();
        $beneficiaryArray = $fractal->createData($personData)->toArray();
        $generalIdentifier = $em->getRepository(GeneralIdentifier::class)->findOneBy(['beneficiary' => $beneficiary]);


        if ($request->isXmlHttpRequest()) {
            $html = $this->render('beneficiary/_include/_general_information.html.twig', ['person' => $beneficiaryArray,]);

            return new JsonResponse($html->getContent());
        }

        return $this->render('beneficiary/detail.html.twig', [
            'person' => $beneficiaryArray,
            'generalIdentifier' => $generalIdentifier,
        ]);
    }

    /**
     * Beneficiary add page.
     *
     * @param Request            $request            Current request
     * @param BeneficiaryService $beneficiaryService The beneficiary service
     *
     * @return Response
     */
    #[Route(path: '/add', name: 'add')]
    public function add(Request $request, BeneficiaryService $beneficiaryService, EdsEntityService $edsEntityService): Response
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
            'parentEdsEntities' => $edsEntityService->getParentEdsEntity(),

        ]);
    }

    /**
     * Beneficiary address add page.
     *
     * @param Request            $request            Current request
     * @param Beneficiary        $beneficiary        Current beneficiary
     * @param BeneficiaryService $beneficiaryService The beneficiary service
     *
     * @return Response
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
     *
     * @param EntityManagerInterface $em          The entity manager
     * @param Request                $request     Current request
     * @param Beneficiary            $beneficiary Current beneficiary
     *
     * @return Response
     */
    #[Route(path: '/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(EntityManagerInterface $em, Request $request, Beneficiary $beneficiary, BeneficiaryService $beneficiaryService): Response
    {
        $form = $this->createForm(BeneficiaryType::class, $beneficiary);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($imageFile = $form->get('imageUrl')->getData()) {
                $beneficiaryService->saveProfilImage($imageFile, $beneficiary);
            }
            if ($birthCertificatFile = $form->get('birthCertificate')->getData()) {
                $beneficiaryService->saveBirthCertificate($birthCertificatFile, $beneficiary);
            }
            $localisationHistory = $form->getData()->getEdsEntity()->toArray();
            foreach ($localisationHistory as $localisation) {
                if ($localisation->getEndedAt() === null) {
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

    /**
     * Ajax call to display beneficiary localisation history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse
     */
    #[Route(path: '/localisation/ajax', name: 'localisation_ajax', options: ['expose' => true], methods: ['POST'])]
    public function localisationAjax(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->request->get('id'));
        $localisation = $beneficiary?->getEdsEntity()->toArray();
        $address = $beneficiary?->getAddress();

        $html = $this->render('beneficiary/_include/_localisation.html.twig', [
            'localisations' => $localisation !== [] ? $localisation : null,
            'address' => $address,
            'beneficiary' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Localisation add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|Response
     */
    #[Route(path: '/localisation/add', name: 'localisation_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function localisationAdd(Request $request, EntityManagerInterface $em, BeneficiaryService $beneficiaryService): RedirectResponse|Response
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(BeneficiaryLocalisationType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addLocalisation($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }


        $html = $this->render('beneficiary/_include/_add_localisation.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing a localisation.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/localisation/delete', name: 'localisation_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function localisationDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $em->remove($em->getRepository(BeneficiaryEdsEntity::class)->find($request->request->get('localisationId')));
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Address add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|Response
     */
    #[Route(path: '/address/add', name: 'address_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function addressAdd(Request $request, EntityManagerInterface $em, BeneficiaryService $beneficiaryService): RedirectResponse|Response
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(AddressType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addAddress($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }


        $html = $this->render('beneficiary/_include/_add_address.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing an address.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return RedirectResponse|JsonResponse
     */
    #[Route(path: '/address/delete', name: 'address_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function addressDelete(EntityManagerInterface $em, Request $request): RedirectResponse|JsonResponse
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $beneficiary->setAddress(null);
        $em->remove($em->getRepository(Address::class)->find($request->request->get('addressId')));
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Ajax call to display beneficiary formation history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse
     */
    #[Route(path: '/formation/ajax', name: 'formation_ajax', options: ['expose' => true], methods: ['POST'])]
    public function formationAjax(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->request->get('id'));
        $formation = $beneficiary?->getFormations()->toArray();
        $html = $this->render('beneficiary/_include/_formation.html.twig', [
            'formations' => $formation !== [] ? $formation : null,
            'beneficiary' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Formation add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|Response
     */
    #[Route(path: '/formation/add', name: 'formation_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function formationAdd(Request $request, EntityManagerInterface $em, BeneficiaryService $beneficiaryService): RedirectResponse|Response
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(BeneficiaryFormationType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addFormation($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }


        $html = $this->render('beneficiary/_include/_add_formation.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing a formation.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/formation/delete', name: 'formation_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function formationDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'));
        $beneficiary?->removeFormation($em->getRepository(Form::class)->find($request->request->get('formationId')));
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Ajax call to display beneficiary health history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse|RedirectResponse
     */
    #[Route(path: '/health/ajax', name: 'health_ajax', options: ['expose' => true], methods: ['POST'])]
    public function healthAjax(Request $request, EntityManagerInterface $em): RedirectResponse|JsonResponse
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $healthEvents = $beneficiary?->getHealthEvent()->toArray();
        $html = $this->render('beneficiary/_include/_health.html.twig', [
            'healthEvents' => $healthEvents !== [] ? $healthEvents : null,
            'beneficiary' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Health add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|JsonResponse|Response
     */
    #[Route(path: '/health/add', name: 'health_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function healthAdd(
        Request $request,
        EntityManagerInterface $em,
        BeneficiaryService $beneficiaryService
    ): RedirectResponse|JsonResponse|Response {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(HealthEventType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addHealthEvent($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        $html = $this->render('beneficiary/_include/_add_heath_event.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing a health event.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/health/delete', name: 'health_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function healthDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'));
        $beneficiary?->removeHealthEvent($em->getRepository(HealthEvent::class)->find($request->request->get('healthEventId')));
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Ajax call to display beneficiary behaviour history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse|RedirectResponse
     */
    #[Route(path: '/behaviour/ajax', name: 'behaviour_ajax', options: ['expose' => true], methods: ['POST'])]
    public function behaviourAjax(Request $request, EntityManagerInterface $em): RedirectResponse|JsonResponse
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $behaviourEvents = $beneficiary?->getBehaviorEvent()->toArray();
        $html = $this->render('beneficiary/_include/_behaviour.html.twig', [
            'behaviourEvents' => $behaviourEvents !== [] ? $behaviourEvents : null,
            'beneficiary' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Behaviour add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|JsonResponse|Response
     */
    #[Route(path: '/behaviour/add', name: 'behaviour_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function behaviourAdd(
        Request $request,
        EntityManagerInterface $em,
        BeneficiaryService $beneficiaryService
    ): RedirectResponse|JsonResponse|Response {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(BehaviourEventType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addBehaviourEvent($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        $html = $this->render('beneficiary/_include/_add_behaviour_event.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing a behaviour event.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/behaviour/delete', name: 'behaviour_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function behaviourDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'));
        $beneficiary?->removeBehaviorEvent($em->getRepository(BehaviorEvent::class)->find($request->request->get('behaviourEventId')));
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Ajax call to display beneficiary interview history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse|RedirectResponse
     */
    #[Route(path: '/interview/ajax', name: 'interview_ajax', options: ['expose' => true], methods: ['POST'])]
    public function interviewAjax(Request $request, EntityManagerInterface $em): RedirectResponse|JsonResponse
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $interviews = $beneficiary?->getInterviewReports()->toArray();
        $html = $this->render('beneficiary/_include/_interview.html.twig', [
            'interviews' => $interviews !== [] ? $interviews : null,
            'beneficiary' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Interview add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|JsonResponse|Response
     */
    #[Route(path: '/interview/add', name: 'interview_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function interviewAdd(
        Request $request,
        EntityManagerInterface $em,
        BeneficiaryService $beneficiaryService
    ): RedirectResponse|JsonResponse|Response {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(InterviewType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addInterview($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        $html = $this->render('beneficiary/_include/_add_interview_event.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing an interview report.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/interview/delete', name: 'interview_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function interviewDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'));
        $beneficiary?->removeInterviewReport($em->getRepository(InterviewReport::class)->find($request->request->get('interviewReportId')));
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Ajax call to display beneficiary family history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse|RedirectResponse
     */
    #[Route(path: '/family/ajax', name: 'family_ajax', options: ['expose' => true], methods: ['POST'])]
    public function familyAjax(Request $request, EntityManagerInterface $em): RedirectResponse|JsonResponse
    {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $familyRelations = $beneficiary?->getFamilyRelation()->toArray();
        $html = $this->render('beneficiary/_include/_family_relation.html.twig', [
            'familyRelations' => $familyRelations !== [] ? $familyRelations : null,
            'beneficiary' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Family relation add page.
     *
     * @param Request                $request            Current request
     * @param EntityManagerInterface $em                 The entity manager
     * @param BeneficiaryService     $beneficiaryService The beneficiary service
     *
     * @return RedirectResponse|JsonResponse|Response
     */
    #[Route(path: '/family/add', name: 'family_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function familyAdd(
        Request $request,
        EntityManagerInterface $em,
        BeneficiaryService $beneficiaryService
    ): RedirectResponse|JsonResponse|Response {
        if (!$beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(FamilyType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $beneficiaryService->addFamily($beneficiary, $form->getData());

            return $this->redirectToRoute('app_beneficiary_detail', ['id' => $beneficiary->getId()]);
        }

        $html = $this->render('beneficiary/_include/_add_family_relation.html.twig', [
            'form' => $form->createView(),
            'person' => $beneficiary,
        ]);

        return new JsonResponse($html->getContent());
    }


    /**
     * Removing a family relation.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/family/delete', name: 'family_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function familyDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $beneficiary = $em->getRepository(Beneficiary::class)->find($request->query->get('id'));
        $beneficiary?->removeFamilyRelation($em->getRepository(FamilyRelation::class)->find($request->request->get('familyRelationId')));
        $em->flush();

        return new JsonResponse();
    }
}
