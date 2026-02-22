<?php

declare(strict_types=1);

namespace App\Identity\Infrastructure\Database\Repository;

use App\Identity\Domain\Entity\User;
use App\Identity\Domain\Repository\UserRepositoryInterface;
use App\Identity\Domain\ValueObject\Email;
use App\Identity\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function add(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->em->getRepository(User::class)->find($id->toString());
    }

    public function findByEmail(Email $email): ?User
    {
        return $this->em->getRepository(User::class)->findOneBy(['email' => $email->value()]);
    }
}
