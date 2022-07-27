<?php

namespace App\Controller;
use App\Entity\Game;
use App\Entity\Media;
use App\Form\GameType;
use App\Services\GameService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class SteamController extends AbstractController
{
    public function index(GameService $gameService, Request $request): Response
    {
        $perPage = 4;
        $page = (int)$request->get('page', 1);
        $gamesDisplay = $gameService->getGames(1, 1);
        $gameDisplay = $gamesDisplay[0] ?? null;
        unset($gamesDisplay);
        $games = $gameService->getGames($page, $perPage);
        $pagination
            = $gameService
            ->getGames($page, $perPage,
                true);
        if ($page !== 1 && count($games) === 0) {
            throw new NotFoundHttpException('Page not found');
        }
        return $this->render('steam/index.html.twig', [
            'controller_name' => 'SteamController',
            'currentPage' => $page,
            'gameDisplay' => $gameDisplay,
            'pagination' => $pagination,
            'games' => $games,
        ]);
    }
    public function product(string      $slug,
                            GameService $gameService
    ): Response
    {
        $game = $gameService->getBySlug($slug);
        if (!$game instanceof Game) {
            throw new NotFoundHttpException('Game not found');
        }
        $similarGames = $gameService->getSimilarGames($game);
        return $this->render('page_achat.html.twig', [
            'controller_name' => 'SteamController',
            'game' => $game,
            'similarGames' => $similarGames,
        ]);
    }
    public function form(Request $request, EntityManagerInterface $em): Response
    {
        $game
            = new Game('Nouveau jeu du' . date('d/m/Y'));
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $files = $form->get('attachement')->getData();
            if (is_array($files) && $files !== []) {
                foreach ($files as $file) {
                    if ($file instanceof UploadedFile) {
                        $ext = $file->guessExtension();
                        $fileName = uniqid('media_', true) . '.' . $ext;
                        $file->move(
                            __DIR__ . '/../../public/assets/uploads',
                            $fileName,
                        );
                        $media = new Media();
                        $media
                            ->setSize(0)
                            ->setFormat($ext)
                            ->setName($fileName)
                            ->setUrl('/assets/uploads/' . $fileName);
                        $em->persist($media);
                        $game->addPicture($media);
                    }
                }
            }
            $em->persist($game);
            $em->flush();
            //dump($file, $game);die;
        }
        return $this->render('page_form_steam.html.twig', [
            'myForm' => $form->createView(),
            'controller_name' => 'SteamController',
        ]);
    }
}
