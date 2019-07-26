<?php

namespace App\Read\Model;

use App\Read\Entity\Todo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Prooph\EventStore\Projection\AbstractReadModel;

class TodoReadModel extends AbstractReadModel
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * TodoReadModel constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function init(): void
    {
        // TODO: Implement init() method.
    }

    public function isInitialized(): bool
    {
        return true;
    }

    public function reset(): void
    {
        // TODO: Implement reset() method.
    }

    public function delete(): void
    {
        // TODO: Implement delete() method.
    }

    public function getAll()
    {
        return $this->entityManager->getRepository(Todo::class)->findAll();
    }

    public function insert(array $data)
    {
        $todo = new Todo();
        $todo
            ->setTodoId($data['id'])
            ->setDescription($data['description'])
            ->setCompleted(false);

        $this->entityManager->persist($todo);
        $this->entityManager->flush($todo);
    }

    public function remove(array $data)
    {
        $todo = $this->entityManager->getRepository(Todo::class)->find($data['id']);

        if (!$todo) {
            return;
        }

        $this->entityManager->remove($todo);
        $this->entityManager->flush();
    }

    public function complete(array $data)
    {
        $todo = $this->entityManager->getRepository(Todo::class)->find($data['id']);

        if (!$todo) {
            return;
        }

        $todo->setCompleted(true);

        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }
}
