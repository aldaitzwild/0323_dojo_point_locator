<?php

namespace App\Controller;

use App\Repository\CellRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GameController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'app_home')]
    #[Route('/game', name: 'app_game')]
    public function play(CellRepository $cellRepository): Response
    {
        $cells = $cellRepository->findAll();
        $cellArray = [];

        foreach($cells as $cell) {
            $cellArray[$cell->getLine()][$cell->getCol()] = $cell;
        }

        return $this->render('game/index.html.twig', [
            'cells' => $cellArray
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/game/cell/{line}/{column}', name: 'app_cell')]
    public function showCell(int $line, int $column, CellRepository $cellRepository): Response
    {
        $cell = $cellRepository->findOneBy(['line' => $line, 'col' => $column]);
        $cell->setIsHidden(false);
        $cellRepository->save($cell, true);

        return $this->redirectToRoute('app_game');
    }
}
