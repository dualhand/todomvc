<?php

namespace App\Write\Infrastructure;

use App\Write\Model\Todo;
use App\Write\Model\TodoId;
use App\Write\Model\TodoRepository;
use Doctrine\DBAL\Connection;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\StreamName;
use Prooph\SnapshotStore\Pdo\PdoSnapshotStore;
use Prooph\SnapshotStore\SnapshotStore;

class ProophTodoRepository extends AggregateRepository implements TodoRepository
{
    /**
     * ProophTodoRepository constructor.
     *
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore, SnapshotStore $snapshotStore)
    {
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass(Todo::class),
            new AggregateTranslator(),
            $snapshotStore,
            new StreamName('todo_event_stream'),
            false,
            false
        );
    }

    public function save(Todo $todo): void
    {
        $this->saveAggregateRoot($todo);
    }

    public function get(TodoId $id): Todo
    {
        return $this->getAggregateRoot($id);
    }
}
