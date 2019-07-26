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
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default"=false})
     */
    private $completed = false;

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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Todo
     */
    public function setDescription(string $description): Todo
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed;
    }

    /**
     * @param bool $completed
     *
     * @return Todo
     */
    public function setCompleted(bool $completed): Todo
    {
        $this->completed = $completed;

        return $this;
    }




}
