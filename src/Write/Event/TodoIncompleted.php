<?php
declare(strict_types=1);

namespace App\Write\Event;

use App\Write\Model\TodoId;
use App\Write\Model\TodoDescription;
use Prooph\EventSourcing\AggregateChanged;

final class TodoIncompleted extends AggregateChanged
{
    public function todoId(): TodoId
    {
        return TodoId::fromString($this->aggregateId());
    }
}
