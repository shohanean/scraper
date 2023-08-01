<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CompanyRepository;

class ScraperController extends AbstractController
{
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('scraper/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    public function create(): Response
    {
        return $this->render('scraper/create.html.twig', [
            'controller_name' => 'ScraperController',
        ]);
    }
}
