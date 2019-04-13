<?php
declare(strict_types=1);

namespace App\Write\Event;

use App\Write\Model\TodoId;
use App\Write\Model\TodoDescription;
use Prooph\EventSourcing\AggregateChanged;

final class TodoCreated extends AggregateChanged
{
    public function todoId(): TodoId
    {
        return TodoId::fromString($this->aggregateId());
    }

    public function description(): TodoDescription
    {
        return TodoDescription::fromString($this->payload['description']);
    }
}
