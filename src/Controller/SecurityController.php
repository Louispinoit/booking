<?php

namespace App\Controller;

use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, RegistrationService $registrationService): Response
    {

        $result = $registrationService->handleRegistration($request);

        if ($result['success']) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $result['form']->createView(),
        ]);
    }
}
