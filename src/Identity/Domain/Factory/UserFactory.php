<?php

declare(strict_types=1);

namespace App\Identity\Domain\Factory;

use App\Identity\Domain\Entity\User;
use App\Identity\Domain\Repository\UserRepositoryInterface;
use App\Identity\Domain\ValueObject\Email;
use App\Identity\Domain\ValueObject\UserId;

final readonly class UserFactory
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function create(Email $email, ?string $hashedPassword = null): User
    {
        if ($this->userRepository->findByEmail($email)) {
            throw new \InvalidArgumentException('User with this email already exists');
        }

        return new User(UserId::generate(), $email, $hashedPassword);
    }
}
