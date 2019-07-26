<?php

namespace App\Write\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class CompleteTodo extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public function id()
    {
        return $this->payload['id'];
    }

    public static function withId(string $id): self
    {
        return new self(['id' => $id]);
    }
}
