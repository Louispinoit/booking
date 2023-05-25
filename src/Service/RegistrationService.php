<?php

namespace App\Service;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService {

    public function __construct(
        private FormFactoryInterface $formFactory,
        private UserPasswordHasherInterface $userPasswordEncoder,
        private EntityManagerInterface $entityManager,
    )  {
    }


    public function handleRegistration(Request $request): array
    {
        $user = new User();
        $form = $this->formFactory->create(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this->userPasswordEncoder->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $name = $form->get('name')->getData();
            $firstname = $form->get('firstname')->getData();
            $user->setName($name);
            $user->setFirstname($firstname);

            $user->setRoles(['ROLE_USER']);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return ['success' => true, 'form' => $form];
        }

        return ['success' => false, 'form' => $form];
    }

}