<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // .. get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        $last_username = $authenticationUtils->getLastUsername();
        // getLastUsername() returns the last login identifier entered by the user
        // Can be an email, username, or any other identifier depending on security configuration
        // Seulement en cas d'erreur de connexion
                
        return $this->render('login/login.html.twig', [
            'last_username' => $last_username,
            'error' => $error,
        ]);


        // return $this->render('login/login.html.twig');
    }

}

