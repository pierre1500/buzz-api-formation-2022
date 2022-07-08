<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SteamController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('steam/index.html.twig', [
            'controller_name' => 'SteamController',
        ]);
    }

    public function product(): Response
    {
        return $this->render('page_achat.html.twig', [
            'controller_name' => 'SteamController',
        ]);
    }

    public function form(): Response
    {
        return $this->render('page_form_steam.html.twig', [
            'controller_name' => 'SteamController',
        ]);
    }



}
