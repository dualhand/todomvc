<?php
/**
 * prooph (http://getprooph.org/)
 *
 * @see       https://github.com/prooph/proophessor-do-symfony for the canonical source repository
 * @copyright Copyright (c) 2016 prooph software GmbH (http://prooph-software.com/)
 * @license   https://github.com/prooph/proophessor-do-symfony/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace App\Command;

use App\Write\Infrastructure\ProophTodoRepository;
use App\Write\Model\Todo;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Projection\ProjectionManager;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Prooph\SnapshotStore\SnapshotStore;
use Prooph\Snapshotter\SnapshotReadModel;
use Prooph\Snapshotter\StreamSnapshotProjection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTodoSnapshotProjectionCommand extends Command
{
    /**
     * @var ProophTodoRepository
     */
    private $proophTodoRepository;
    /**
     * @var SnapshotStore
     */
    private $snapshotStore;
    /**
     * @var ProjectionManager
     */
    private $projectionManager;

    public function __construct(ProjectionManager $projectionManager, ProophTodoRepository $proophTodoRepository, SnapshotStore $snapshotStore)
    {
        $this->proophTodoRepository = $proophTodoRepository;
        $this->snapshotStore = $snapshotStore;
        parent::__construct();
        $this->projectionManager = $projectionManager;
    }

    protected function configure()
    {
        $this->setName('snapshot:projection:todo')
            ->setDescription('Create snapshot projection todo.')
            ->setHelp('This command creates the projector for to do snapshots');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projection = $this->projectionManager->createReadModelProjection(
            'todo-snapshots',
            new SnapshotReadModel(
                $this->proophTodoRepository,
                new AggregateTranslator(),
                $this->snapshotStore,
                [
                    Todo::class,
                ]
            )
        );

        $streamSnapshotProjection = new StreamSnapshotProjection($projection, 'todo_event_stream');
        $streamSnapshotProjection();
    }
}
