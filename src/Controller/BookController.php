<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class BookController extends AbstractController
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    #[Route('/book', name: 'app_book')]
    public function index(Request $request): Response
    {
        $ref = $request->query->get('ref'); // Get the search parameter from the query string
        $books = [];

        if ($ref) {
            $books = $this->bookRepository->searchBookByRef($ref);
        }
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books,
            'ref' => $ref
        ]);
    }
    #[Route('/book/showbyauth', name: 'app_book_by_auth')]
    public function showByAuth(): Response
    {
        $books = $this->bookRepository->booksListByAuthors();
        return $this->render('book/bookbyauth.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books,
        ]);
    }
}
