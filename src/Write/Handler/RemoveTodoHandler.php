<?php

declare(strict_types=1);

namespace App\Write\Handler;

use App\Write\Command\CreateTodo;
use App\Write\Command\RemoveTodo;
use App\Write\Model\TodoId;
use App\Write\Model\Todo;
use App\Write\Model\TodoRepository;

class RemoveTodoHandler
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

    public function __invoke(RemoveTodo $command): void
    {
        $id = $command->id();
        /** @var Todo $todo */
        $todo = $this->todoRepository->get(TodoId::fromString($id));
        $todo->remove();
        $this->todoRepository->save($todo);
    }
}
