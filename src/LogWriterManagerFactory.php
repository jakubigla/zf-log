<?php

namespace QEngineLog\Log;

use Zend\Log\WriterPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LogWriterManagerFactory
 *
 * @package QEngineLog\Log
 * @author  Jakub Igla <jakub.igla@valtech.co.uk>
 */
class LogWriterManagerFactory implements FactoryInterface
{
    const OPTIONS_KEY = 'writer_plugin_manager';

    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return WriterPluginManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (! isset($config[self::OPTIONS_KEY])) {
            $config[self::OPTIONS_KEY] = [];
        }

        $managerOptions = new Config($config[self::OPTIONS_KEY]);
        $writerManager  = new WriterPluginManager($managerOptions);
        $writerManager->setServiceLocator($serviceLocator);

        return $writerManager;
    }
}
