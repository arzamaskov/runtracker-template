<?php

declare(strict_types=1);

namespace App\Tests\Unit\Identity\Domain\Entity;

use App\Identity\Domain\Entity\User;
use App\Identity\Domain\ValueObject\Email;
use App\Identity\Domain\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_it_creates_user_with_valid_properties(): void
    {
        // arrange
        $id = UserId::generate();
        $email = Email::fromString('email@example.com');
        // act
        $user = new User($id, $email);
        // assert
        self::assertTrue($id->equals($user->id()));
        self::assertTrue($email->equals($user->email()));
        self::assertNull($user->password());
        self::assertContains('ROLE_USER', $user->roles());
    }
}
