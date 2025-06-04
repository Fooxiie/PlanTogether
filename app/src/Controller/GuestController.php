<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class GuestController extends AbstractController
{
    #[Route('/guest', name: 'app_guest')]
    public function index(): Response
    {
        return $this->render('guest/index.html.twig');
    }

    #[Route('/guest/login', name: 'app_guest_login')]
    public function login(SessionInterface $session): Response
    {
        $session->set('guest', true);

        return $this->redirectToRoute('app_home');
    }
}
