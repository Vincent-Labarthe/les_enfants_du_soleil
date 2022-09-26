<?php

namespace App\Controller;

use App\Service\ExportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/export', name: 'export_')]
class ExportController extends AbstractController
{
    #[Route(name: 'index')]
    public function export(Request $request, ExportService $exportService)
    {
        $exportService->generateExport($request->query->get('type'), $request->query->get('data'));
        dd($request);
    }
}