<?php

namespace App\Read\Projector;

use App\Read\Model\TodoReadModel;
use App\Write\Command\RemoveTodo;
use App\Write\Event\TodoCompleted;
use App\Write\Event\TodoCreated;
use App\Write\Event\TodoIncompleted;
use App\Write\Event\TodoRemoved;
use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;

class TodoProjector implements ReadModelProjection
{
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        /** @var TodoReadModel $readModel */
        $readModel = $projector->readModel();

        $projector
            ->fromStream('todo_event_stream')
            ->when(
                [
                    TodoCreated::class => function ($state, TodoCreated $event) use ($readModel) {
                        $readModel->stack(
                            'insert',
                            [
                                'id' => $event->todoId(),
                                'description' => $event->description()->toString(),
                            ]
                        );
                    },
                    TodoRemoved::class => function ($state, TodoRemoved $event) use ($readModel) {
                        $readModel->stack(
                            'remove',
                            [
                                'id' => $event->todoId(),
                            ]
                        );
                    },
                    TodoCompleted::class => function ($state, TodoCompleted $event) use ($readModel) {
                        $readModel->stack(
                            'complete',
                            [
                                'id' => $event->todoId(),
                            ]
                        );
                    },
                    TodoIncompleted::class => function ($state, TodoIncompleted $event) use ($readModel) {
                        $readModel->stack(
                            'incomplete',
                            [
                                'id' => $event->todoId(),
                            ]
                        );
                    }
                ]
            );

        return $projector;
    }
}
