<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AuthorType;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $authors = $entityManagerInterface
            ->getRepository(Author::class)
            ->ListAuthors();
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
            'authors' => $authors,
        ]);
    }

    #[Route('author/delete/{id}', name: 'app_author_delete')]
    public function deleteAuthor($id, EntityManagerInterface $entityManagerInterface): Response
    {
        try {
            $entityManagerInterface->getRepository(Author::class)->DeleteAuthor($id);
            return $this->redirectToRoute('app_author');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error deleting author' . $e->getMessage());
        }
    }
    #[Route('/author/add', name: 'app_author_add')]
    public function addAuthor(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $form = $this->createForm(AuthorType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();
            try {
                $entityManagerInterface->getRepository(Author::class)->AddAuthor($author);
                return $this->redirectToRoute('app_author');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error adding author' . $e->getMessage());
            }
        }
        return $this->render('author/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
