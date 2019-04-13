<?php

namespace App\Write\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

final class CreateTodo extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public function description()
    {
        return $this->payload['description'];
    }

    public static function withDescription(string $description): self
    {
        return new self(['description' => $description]);
    }
}
