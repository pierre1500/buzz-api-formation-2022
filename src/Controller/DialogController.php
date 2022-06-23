<?php

namespace App\Controller;

use App\Services\TrollService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DialogController extends AbstractController
{
    public function defaultAction(
        Request      $request,
        TrollService $trollService
    ): JsonResponse
    {
        $nomDuBobby = $request->get('bobby', null);
        return $this->json([
            'message' => $trollService->getTroll($nomDuBobby),
        ]);
    }
}
