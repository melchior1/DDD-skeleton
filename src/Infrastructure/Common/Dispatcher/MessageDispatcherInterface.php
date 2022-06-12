<?php

namespace Infrastructure\Common\Dispatcher;


use Domain\Utils\Message\MessageInterface;

interface MessageDispatcherInterface
{
    public function dispatchMessage(MessageInterface $message): mixed;

}
