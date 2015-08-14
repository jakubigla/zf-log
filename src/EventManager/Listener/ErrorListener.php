<?php

namespace QEngine\Log\EventManager\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Log\Logger;
use Zend\Log\Processor;
use Zend\Mvc\MvcEvent;

/**
 * Class ErrorListener
 *
 * @package QEngineLog\EventManager\Listener\ErrorListener
 * @author Jakub Igla <jakub.igla@valtech.co.uk>
 */
class ErrorListener extends AbstractListenerAggregate implements ListenerAggregateInterface
{
    const PRIORITY = 0;

    /** @var MvcEvent */
    private $mvcEvent;

    public function __construct(MvcEvent $mvcEvent)
    {
        $this->mvcEvent = $mvcEvent;
    }

    /**
     * Attach handleLocale listener
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            array(
                $this,
                'onError'
            ),
            self::PRIORITY
        );

        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            array(
                $this,
                'onError'
            ),
            self::PRIORITY
        );
    }

    /**
     * Listener callback
     */
    public function onError()
    {
        $this->verifyIsError();

        /** @var \Exception $exception */
        $exception = $this->mvcEvent->getParam('exception');
        $logger    = $this->getLogger();

        $logger->err($exception);
    }

    /**
     * Verify is error
     *
     * @throws \LogicException
     */
    private function verifyIsError()
    {
        $error = $this->mvcEvent->getError();
        if (!$error) {
            throw new \LogicException("This listener is only meant to be called on errors");
        }
    }

    /**
     * Get logger
     *
     * @return Logger
     */
    private function getLogger()
    {
        return $this->mvcEvent->getApplication()->getServiceManager()->get(Logger::class);
    }
}
