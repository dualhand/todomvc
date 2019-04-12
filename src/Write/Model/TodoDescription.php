<?php
declare(strict_types=1);

namespace App\Write\Model;

final class TodoDescription
{
    private $description;

    public static function fromString(string $description): self
    {
        return new self($description);
    }

    private function __construct(string $description)
    {
        $this->description = $description;
    }

    public function toString(): string
    {
        return $this->description;
    }

    public function equals($other): bool
    {
        if (!$other instanceof self) {
            return false;
        }

        return $this->description === $other->description;
    }
}
