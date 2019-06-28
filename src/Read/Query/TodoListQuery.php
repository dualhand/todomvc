<?php
declare(strict_types=1);

namespace App\Read\Query;

use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Prooph\Common\Messaging\Query;

class TodoListQuery extends Query implements PayloadConstructable
{
    use PayloadTrait;
}
