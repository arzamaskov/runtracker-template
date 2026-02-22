<?php

declare(strict_types=1);

namespace App\Identity\Domain\ValueObject;

use Symfony\Component\Uid\Uuid;

final readonly class UserId
{
    private function __construct(private Uuid $userId)
    {
    }

    public static function generate(): self
    {
        return new self(Uuid::v7());
    }

    public static function fromString(string $userId): self
    {
        if (!Uuid::isValid($userId)) {
            throw new \InvalidArgumentException('Invalid user id');
        }

        return new self(Uuid::fromString($userId));
    }

    public function value(): Uuid
    {
        return $this->userId;
    }

    public function toString(): string
    {
        return $this->userId->toRfc4122();
    }

    public function equals(self $other): bool
    {
        return $this->userId->toString() === $other->userId->toString();
    }
}
