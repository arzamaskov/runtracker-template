<?php

declare(strict_types=1);

namespace App\Tests\Unit\Identity\Domain\Factory;

use App\Identity\Domain\Entity\User;
use App\Identity\Domain\Factory\UserFactory;
use App\Identity\Domain\Repository\UserRepositoryInterface;
use App\Identity\Domain\ValueObject\Email;
use App\Identity\Domain\ValueObject\UserId;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_it_creates_user_when_email_is_available(): void
    {
        // arrange
        $repository = $this->createMock(UserRepositoryInterface::class);
        $repository
            ->expects(self::once())
            ->method('findByEmail')
            ->with(Email::fromString('test@example.com'))
            ->willReturn(null);
        $factory = new UserFactory($repository);
        // act
        $user = $factory->create(Email::fromString('test@example.com'), 'hashed');
        // assert
        self::assertTrue($user->email()->equals(Email::fromString('test@example.com')));
        self::assertSame('hashed', $user->password());
    }

    /**
     * @throws Exception
     */
    public function test_it_throws_exception_when_email_already_exists(): void
    {
        // arrange
        $repository = $this->createMock(UserRepositoryInterface::class);
        $existingUser = new User(UserId::generate(), Email::fromString('test@example.com'));
        $repository
            ->expects(self::once())
            ->method('findByEmail')
            ->willReturn($existingUser);
        $factory = new UserFactory($repository);
        // act
        self::expectException(\InvalidArgumentException::class);
        $user = $factory->create(Email::fromString('test@example.com'), 'hashed');
    }
}
