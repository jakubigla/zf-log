<?php

namespace QEngine\Log;

use Zend\Log\ProcessorPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LogProcessorManagerFactory
 *
 * @package QEngineLog\Log
 * @author  Jakub Igla <jakub.igla@valtech.co.uk>
 */
class LogProcessorManagerFactory implements FactoryInterface
{
    const OPTIONS_KEY = 'processor_plugin_manager';

    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ProcessorPluginManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (! isset($config[self::OPTIONS_KEY])) {
            $config[self::OPTIONS_KEY] = [];
        }

        $managerOptions   = new Config($config[self::OPTIONS_KEY]);
        $processorManager = new ProcessorPluginManager($managerOptions);
        $processorManager->setServiceLocator($serviceLocator);

        return $processorManager;
    }
}
