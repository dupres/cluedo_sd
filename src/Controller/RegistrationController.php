<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        Security $security,
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profile');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Remplit le formulaire (et donc $user) avec les données envoyées, s'il y en a.
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // On ne stocke jamais le mot de passe en clair : seulement son empreinte.
            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user); // "prends cet objet en charge"
            $entityManager->flush();        // "exécute les requêtes SQL maintenant"

            $this->addFlash('success', sprintf('Bienvenue %s, ton compte a bien été créé !', $user->getUsername()));

            // Connecte directement le nouvel utilisateur, comme s'il était passé
            // par le formulaire de connexion du pare-feu "main".
            return $security->login($user, 'form_login', 'main')
                ?? $this->redirectToRoute('app_profile');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
