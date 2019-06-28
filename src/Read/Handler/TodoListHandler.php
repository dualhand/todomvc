<?php
declare(strict_types=1);

namespace App\Read\Handler;

use App\Read\Model\TodoReadModel;
use App\Read\Query\TodoListQuery;
use React\Promise\Deferred;

class TodoListHandler
{
    /**
     * @var TodoReadModel
     */
    private $model;

    public function __construct(TodoReadModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(TodoListQuery $query, Deferred $deferred = null)
    {
        $todos = $this->model->getAll();

        $deferred->resolve($todos);
    }
}
