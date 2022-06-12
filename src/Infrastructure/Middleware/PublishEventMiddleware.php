<?php

namespace Infrastructure\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Utils\Event\EventManagerInterface;
use Infrastructure\Service\Event\EventPersist;
use Infrastructure\Service\Event\EventPublisher;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Throwable;

class PublishEventMiddleware implements MiddlewareInterface
{

    public function __construct(
        private EventManagerInterface $eventManager,
        private EventPersist $eventPersist,
        private EventPublisher $eventPublisher,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        //execute all middleware first
        //FYI: HandleMessageMiddleware is the last executed middleware who find the handler
        $result = $stack->next()->handle($envelope, $stack);

        if (!$this->eventManager->hasEvent()) {
            return $result;
        }

        $this->eventPersist->store();

        $this->entityManager->beginTransaction();
        try {
            //flush all data
            $this->entityManager->flush();
            //commit data
            $this->entityManager->getConnection()->commit();
            $this->entityManager->clear();
            // Remove doctrine cache after flush to get fresh data
            $this->entityManager->getConfiguration()->getResultCache()?->clear();
        } catch (Throwable $exception) {
            $this->entityManager->getConnection()->rollBack();
            throw $exception;
        }
        $this->eventPublisher->publishEvents();

        return $result;
    }
}
