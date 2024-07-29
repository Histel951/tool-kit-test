<?php
declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function processRegistration(User $user): void
    {
        $hashPassword = $this->passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}