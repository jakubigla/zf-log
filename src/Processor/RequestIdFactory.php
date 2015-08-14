<?php

namespace QEngineLog\Log\Processor;

use QEngine\Mvc\Application;
use Zend\Log\ProcessorPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class RequestIdFactory
 *
 * @package QEngineLog\Log\Processor
 * @author Jakub Igla <jakub.igla@valtech.co.uk>
 */
class RequestIdFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return RequestId
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if (! $serviceLocator instanceof ProcessorPluginManager) {
            throw new \BadMethodCallException('This factory is only meant to be used with ProcessorPluginManager');
        }

        /** @var Application $application */
        $parentLocator = $serviceLocator->getServiceLocator();
        $application   = $parentLocator->get('Application');

        $processor     = new RequestId($application->getRequestId());

        return $processor;
    }
}
