<?php

namespace QEngine\Log;

use QEngine\Mvc\Application;
use Zend\Log\Logger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Processor;

/**
 * Class LoggerFactory
 *
 * @package QEngine\Log
 * @author Jakub Igla <jakub.igla@valtech.co.uk>
 */
class LoggerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Logger
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ModuleOptions $options */
        /** @var Application   $application */
        $options       = $serviceLocator->get(ModuleOptions::class);
        $loggerOptions = $options->getLog();

        $loggerOptions['processor_plugin_manager'] = $serviceLocator->get(Application::LOG_PROCESSOR_MANAGER);
        $loggerOptions['writer_plugin_manager']    = $serviceLocator->get(Application::LOG_WRITER_MANAGER);

        $logger = new Logger($loggerOptions);

        return $logger;
    }
}
