<?php

namespace QEngine\Log;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ModuleOptionsFactory
 *
 * @package QEngine\Log
 * @author Jakub Igla <jakub.igla@gmail.com>
 */
class ModuleOptionsFactory implements FactoryInterface
{
    const OPTIONS_KEY = 'QEngineLog';
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ModuleOptions($serviceLocator->get('Config')[self::OPTIONS_KEY]);
    }
}
