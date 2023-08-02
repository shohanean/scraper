<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CompanyRepository;
use App\Form\CompanyFormType;
use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

class ScraperController extends AbstractController
{
    public function index(CompanyRepository $companyRepository): Response
    {
        $form = $this->createForm(CompanyFormType::class);

        return $this->render('scraper/index.html.twig', [
            'companies' => $companyRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    public function create(): Response
    {
        return $this->render('scraper/create.html.twig', [
            'controller_name' => 'ScraperController',
        ]);
    }

    public function store(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(CompanyFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Process the form data...
            $formData = $form->getData();

            // Create a new company object and set its properties
            $company = new Company();
            $company->setName($formData['name']);
            $company->setPrice($formData['price']);
            $company->setDescription($formData['description']);

            // Use the EntityManager to persist and save the entity to the database
            $entityManager = $doctrine->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            // Redirect to a success page or show a success message
            $this->addFlash('success', 'Action completed successfully.');
            return $this->redirectToRoute('scraper_index');
        } else {
            return new Response('There are some error');
        }
    }

    public function destroy(EntityManagerInterface $entityManager, CompanyRepository $companyRepository, $id): Response
    {
        $entityManager->remove($companyRepository->find($id));
        $entityManager->flush();
        $this->addFlash('success', 'Entry deleted successfully.');
        return $this->redirectToRoute('scraper_index');
    }
}
