<?php

namespace CascadeEnergy\SymfonyEventDispatcher;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

trait EventDispatcherConsumerTrait
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher The EventDispatcher instance to use
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Dispatches an event to the event dispatcher, if one has been configured.
     *
     * @param string $eventName The name of the event to dispatch
     * @param Event|null $event The (optional) event object
     */
    public function dispatchEvent($eventName, Event $event = null)
    {
        if ($this->eventDispatcher instanceof EventDispatcherInterface) {
            $this->eventDispatcher->dispatch($eventName, $event);
        }
    }
}
