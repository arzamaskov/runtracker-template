<?php

declare(strict_types=1);

namespace App\Identity\Infrastructure\Database\Doctrine\Type;

use App\Identity\Domain\ValueObject\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class EmailType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL(['length' => 180]);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Email ? $value->value() : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        return null !== $value ? Email::fromString($value) : null;
    }
}
