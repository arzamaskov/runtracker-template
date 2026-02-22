<?php

declare(strict_types=1);

namespace App\Identity\Infrastructure\Database\Doctrine\Type;

use App\Identity\Domain\ValueObject\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class UserIdType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof UserId ? $value->toString() : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserId
    {
        return null !== $value ? UserId::fromString($value) : null;
    }
}
