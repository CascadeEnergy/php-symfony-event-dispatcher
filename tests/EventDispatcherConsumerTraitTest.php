<?php

namespace CascadeEnergy\Tests\SymfonyEventDispatcher;

use CascadeEnergy\SymfonyEventDispatcher\EventDispatcherConsumerTrait;

class EventDispatcherConsumerTraitTest extends \PHPUnit_Framework_TestCase
{
    /** @var EventDispatcherConsumerTrait */
    private $eventDispatcherConsumerTrait;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $eventDispatcher;

    public function setUp()
    {
        $this->eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        $this->eventDispatcherConsumerTrait = $this->getMockForTrait(
            'CascadeEnergy\SymfonyEventDispatcher\EventDispatcherConsumerTrait'
        );
    }

    public function testItShouldAcceptAnEventDispatcherInstance()
    {
        /** @noinspection PhpParamsInspection */
        $this->eventDispatcherConsumerTrait->setEventDispatcher($this->eventDispatcher);

        $this->assertAttributeSame($this->eventDispatcher, 'eventDispatcher', $this->eventDispatcherConsumerTrait);
    }

    public function testItShouldRaiseNoExceptionsOrErrorsIfAnEventDispatcherIsNotProvided()
    {
        $this->eventDispatcherConsumerTrait->dispatchEvent('foo');
    }

    public function testItShouldDispatchTheEventIfADispatcherIsAvailable()
    {
        $event = $this->getMock('Symfony\Component\EventDispatcher\Event');

        /** @noinspection PhpParamsInspection */
        $this->eventDispatcherConsumerTrait->setEventDispatcher($this->eventDispatcher);

        $this->eventDispatcher->expects($this->once())->method('dispatch')->with('foo', $event);

        $this->eventDispatcherConsumerTrait->dispatchEvent('foo', $event);
    }
}
