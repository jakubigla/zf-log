<?php

namespace QEngine\Log;

use QEngine\Log\Processor;
use QEngine\Log\Writer;
use QEngine\Mvc\Application;
use Zend\Log\Logger;

return [
    'log' => [
        'enabled' => true,
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

    'service_manager' => [
        'factories' => [
            Application::LOG_PROCESSOR_MANAGER => LogProcessorManagerFactory::class,
            Application::LOG_WRITER_MANAGER    => LogWriterManagerFactory::class,
            Application::LOGGER                => LoggerFactory::class,
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
