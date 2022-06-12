<?php

namespace Infrastructure\Common;

use Application\Shared\Message\CommandInterface;
use Application\Shared\Message\QueryInterface;
use Domain\Utils\Message\MessageInterface;
use Infrastructure\Common\Dispatcher\MessageDispatcherInterface;
use Infrastructure\Common\Response\ResponseManagerInterface;

abstract class AbstractController
{
    public function __construct(
        protected ResponseManagerInterface $responseManager,
        protected MessageDispatcherInterface $messengerDispatcher
    ) {
    }

    public function query(MessageInterface $message): mixed
    {
        return $this->messengerDispatcher->dispatchMessage($message);
    }

    public function command(MessageInterface $message): mixed
    {
        return $this->messengerDispatcher->dispatchMessage($message);
    }

}
