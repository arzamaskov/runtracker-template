<?php

declare(strict_types=1);

namespace App\Identity\Domain\ValueObject;

final readonly class Email
{
    private function __construct(private string $email)
    {
    }

    public static function fromString(string $email): self
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email');
        }

        return new self(strtolower($email));
    }

    public function value(): string
    {
        return $this->email;
    }

    public function equals(self $other): bool
    {
        return $this->email === $other->email;
    }
}
