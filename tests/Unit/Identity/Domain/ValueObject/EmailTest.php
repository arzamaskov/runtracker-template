<?php

declare(strict_types=1);

namespace App\Tests\Unit\Identity\Domain\ValueObject;

use App\Identity\Domain\ValueObject\Email;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    public function test_it_creates_email_from_valid_string(): void
    {
        // arrange
        $email = Email::fromString('email@example.com');
        // act
        // assert
        self::assertSame('email@example.com', $email->value());
    }

    public function test_it_throws_exception_for_invalid_email(): void
    {
        // arrange
        self::expectException(\InvalidArgumentException::class);
        // act
        Email::fromString('non-email');
        // assert
    }

    public function test_it_normalize_email_to_lowercase(): void
    {
        // arrange
        $email = Email::fromString('EMAIL@example.COM');
        // act
        // assert
        self::assertSame('email@example.com', $email->value());
    }

    public function test_two_equals_emails_are_equal(): void
    {
        // arrange
        $email1 = Email::fromString('email@example.com');
        $email2 = Email::fromString('email@example.com');
        // act
        // assert
        self::assertTrue($email1->equals($email2));
    }

    public function test_two_different_emails_are_not_equal(): void
    {
        // arrange
        $email1 = Email::fromString('email@example.com');
        $email2 = Email::fromString('other@example.com');
        // act
        // assert
        self::assertFalse($email1->equals($email2));
    }
}
