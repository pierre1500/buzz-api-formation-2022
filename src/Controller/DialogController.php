<?php

namespace App\Controller;

use App\Services\TrollService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DialogController extends AbstractController
{
    public function defaultAction(
        Request      $request,
        TrollService $trollService
    ): Response
    {
        {
            $nomDuBobby = $request->get('bobby', null);
            return $this->render('index.html.twig', [
                'troll' => $trollService->getTroll($nomDuBobby),
            ]);
        }
    }
}
