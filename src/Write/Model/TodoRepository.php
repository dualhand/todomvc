<?php

declare(strict_types=1);

namespace App\Write\Model;

interface TodoRepository
{
    public function save(Todo $todo): void;

    public function get(TodoId $id): Todo;
}
