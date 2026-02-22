<?php

declare(strict_types=1);

namespace App\Identity\Domain\Entity;

use App\Identity\Domain\ValueObject\Email;
use App\Identity\Domain\ValueObject\UserId;

final class User
{
    /**
     * @param array<string> $roles
     */
    public function __construct(
        private readonly UserId $id,
        private Email $email,
        private ?string $password = null,
        private array $roles = [],
    ) {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): ?string
    {
        return $this->password;
    }

    public function changePassword(string $newPassword): void
    {
        $this->password = $newPassword;
    }

    public function changeEmail(Email $newEmail): void
    {
        $this->email = $newEmail;
    }

    /**
     * @return array<string>
     */
    public function roles(): array
    {
        return $this->roles;
    }
}
