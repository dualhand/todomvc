<?php

namespace App\Write\Infrastructure;

use App\Write\Model\Todo;
use App\Write\Model\TodoRepository;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;

class ProophTodoRepository extends AggregateRepository implements TodoRepository
{
    /**
     * ProophTodoRepository constructor.
     *
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(Todo::class),
            new AggregateTranslator(),
            null,
            null,
            true,
            false
        );
    }

    public function save(Todo $todo): void
    {
        $this->saveAggregateRoot($todo);
    }
}
