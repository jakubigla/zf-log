<?php

namespace QEngine\Log;

use QEngine\Log\LoggerFactory;
use QEngine\Log\LogProcessorManagerFactory;
use QEngine\Log\LogWriterManagerFactory;
use QEngine\Log\Processor;
use QEngine\Log\Writer;
use QEngine\Mvc\Application;
use Zend\Logger;

return [
    'QEngine\Log' => [
        'log' => [
            'writers' => [
                Writer\Stream::class => [
                    'name'      => 'stream',
                    'options'   => [
                        'stream' => '/var/log/application/general.log',
                        'filters' => [
                            'Priority' => [
                                'name'      => 'Priority',
                                'options'   => [
                                    'priority' => Logger::DEBUG,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'processors' => [
                ['name' => Processor\RequestId::class],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Application::APPLICATION           => ApplicationFactory::class,
            Application::LOG_PROCESSOR_MANAGER => LogProcessorManagerFactory::class,
            Application::LOG_WRITER_MANAGER    => LogWriterManagerFactory::class,
            Application::LOGGER                => LoggerFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'requestId' => RequestIdHelperFactory::class,
        ],
    ],
    'processor_plugin_manager' => [
        'factories' => [
            Processor\RequestId::class => Processor\RequestIdFactory::class,
        ],
    ],
    'writer_plugin_manager' => [
        'invokables' => [
            'stream' => Writer\Stream::class,
        ],
    ],
];
