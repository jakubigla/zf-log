<?php

namespace QEngine\Log;

use Zend\Stdlib\AbstractOptions;

/**
 * Class ModuleOptions
 *
 * @package QEngine\Log
 * @author Jakub Igla <jakub.igla@gmail.com>
 */
final class ModuleOptions extends AbstractOptions
{
    const ENV_LOG_PATH = 'LOG_PATH';

    /** @var array */
    private $loggerOptions;

    /**
     * @return array
     */
    public function getLoggerOptions()
    {
        return $this->loggerOptions;
    }

    /**
     * @param array $loggerOptions
     *
     * @return $this
     */
    public function setLoggerOptions($loggerOptions)
    {
        $this->loggerOptions = $loggerOptions;
        return $this;
    }
}
