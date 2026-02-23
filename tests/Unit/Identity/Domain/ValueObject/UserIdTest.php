<?php

declare(strict_types=1);

namespace App\Tests\Unit\Identity\Domain\ValueObject;

use App\Identity\Domain\ValueObject\UserId;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

final class UserIdTest extends TestCase
{
    public function test_it_generate_valid_uuid(): void
    {
        // arrange
        $userId = UserId::generate();
        // act
        // assert
        self::assertTrue(Uuid::isValid($userId->toString()));
    }

    public function test_it_creates_from_valid_uuid_string(): void
    {
        // arrange
        $uuid = Uuid::v7()->toRfc4122();
        // act
        $userId = UserId::fromString($uuid);
        // assert
        self::assertSame($uuid, $userId->toString());
    }

    public function test_it_throws_exception_for_invalid_uuid(): void
    {
        // arrange
        self::expectException(\InvalidArgumentException::class);
        // act
        UserId::fromString('non-uuid');
        // assert
    }

    public function test_two_same_ids_are_equal(): void
    {
        // arrange
        $uuid = Uuid::v7()->toRfc4122();
        // act
        $id1 = UserId::fromString($uuid);
        $id2 = UserId::fromString($uuid);
        // assert
        self::assertTrue($id1->equals($id2));
    }

    public function test_two_different_ids_are_not_equal(): void
    {
        // arrange
        // act
        $id1 = UserId::generate();
        $id2 = UserId::generate();
        // assert
        self::assertFalse($id1->equals($id2));
    }
}
