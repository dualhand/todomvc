<?php
declare(strict_types=1);

namespace App\Write\Model;

final class TodoId
{
    private $uuid;

    public static function fromString(string $todoId): self
    {
        return new self($todoId);
    }

    private function __construct(string $todoId)
    {
        $this->uuid = $todoId;
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->uuid === $other->uuid;
    }
}
