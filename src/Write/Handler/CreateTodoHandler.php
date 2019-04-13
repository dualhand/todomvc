<?php

declare(strict_types=1);

namespace App\Write\Handler;

use App\Write\Command\CreateTodo;
use App\Write\Model\TodoId;
use App\Write\Model\Todo;
use App\Write\Model\TodoRepository;

class CreateTodoHandler
{
    /**
     * @var TodoRepository
     */
    private $todoRepository;

    /**
     * CreateTodoHandler constructor.
     *
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function __invoke(CreateTodo $command): void
    {
        $todo = Todo::create(TodoId::fromString(uniqid()), $command->description());

        $this->todoRepository->save($todo);
    }
}
