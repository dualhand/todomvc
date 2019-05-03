<?php

namespace App\Read\Entity;

use App\Write\Model\TodoId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Todo
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="todo_id")
     */
    private $todoId;

    /**
     * @return TodoId
     */
    public function getTodoId(): TodoId
    {
        return $this->todoId;
    }

    /**
     * @param TodoId $todoId
     *
     * @return Todo
     */
    public function setTodoId(TodoId $todoId): Todo
    {
        $this->todoId = $todoId;

        return $this;
    }
}
