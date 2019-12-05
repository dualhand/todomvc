<?php

declare(strict_types=1);

namespace App\Write\Model;

use App\Write\Event\TodoCompleted;
use App\Write\Event\TodoCreated;
use App\Write\Event\TodoIncompleted;
use App\Write\Event\TodoRemoved;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

final class Todo extends AggregateRoot
{
    /** @var TodoId */
    private $id;

    /** @var TodoDescription */
    private $description;

    /** @var boolean */
    private $removed;

    /** @var boolean */
    private $completed;

    public static function create(TodoId $todoId, string $description): self
    {
        $self = new self();

        $self->recordThat(TodoCreated::occur($todoId->toString(), ['description' => $description]));

        return $self;
    }

    public function remove(): void
    {
        $this->recordThat(TodoRemoved::occur($this->id->toString()));
    }

    public function complete()
    {
        $this->recordThat(TodoCompleted::occur($this->id->toString()));
    }

    public function incomplete()
    {
        $this->recordThat(TodoIncompleted::occur($this->id->toString()));
    }

    protected function aggregateId(): string
    {
        return $this->id->toString();
    }

    protected function apply(AggregateChanged $event): void
    {
        switch ($event->messageName()) {
            case TodoCreated::class:
                /* @var TodoCreated $event */

                $this->id = $event->todoId();
                $this->description = $event->description();
                $this->removed = false;
                $this->completed = false;
                break;
            case TodoRemoved::class:
                $this->removed = true;
                break;
            case TodoCompleted::class:
                $this->completed = true;
                break;
            case TodoIncompleted::class:
                $this->completed = false;
                break;
        }
    }
}
