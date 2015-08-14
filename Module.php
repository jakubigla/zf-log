<?php

namespace QEngine\Log;

use QEngine\Log\EventManager\Listener\ErrorListener;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 *
 * @package QEngineLog
 * @author Jakub Igla <jakub.igla@gmail.com>
 */
class Module implements ConfigProviderInterface, ServiceProviderInterface
{
    /**
     * Bootstrap module
     *
     * @param MvcEvent $event
     * @return array
     */
    public function onBootstrap(MvcEvent $event)
    {
        $localeListener = new ErrorListener($event);
        $localeListener->attach($event->getApplication()->getEventManager());
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories'  => [
                ModuleOptions::class => ModuleOptionsFactory::class,
            ],
        ];
    }
}
