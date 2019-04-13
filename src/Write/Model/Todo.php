<?php

declare(strict_types=1);

namespace App\Write\Model;

use App\Write\Event\TodoCreated;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

final class Todo extends AggregateRoot
{
    /** @var TodoId */
    private $id;

    /** @var TodoDescription */
    private $description;

    public static function create(TodoId $todoId, string $description): self
    {
        $self = new self();

        $self->recordThat(TodoCreated::occur($todoId->toString(), ['description' => $description]));

        return $self;
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
                break;
        }
    }
}
