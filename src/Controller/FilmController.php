<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film', methods: ['GET'])]
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll(); 

        return $this->render('film/index.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/film/{id}', name: 'app_film_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id, FilmRepository $filmRepository): Response
    {
        $film = $filmRepository->find($id);

        if(!$film) {
            throw $this->createNotFoundException('Ce film n\'existe pas.');
        }

        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }
}
