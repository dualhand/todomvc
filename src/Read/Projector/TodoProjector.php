<?php

namespace App\Read\Projector;

use App\Read\Model\TodoReadModel;
use App\Write\Event\TodoCreated;
use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;

class TodoProjector implements ReadModelProjection
{
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        /** @var TodoReadModel $readModel */
        $readModel = $projector->readModel();

        $projector
            ->fromAll()
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
                ]
            );

        return $projector;
    }
}
