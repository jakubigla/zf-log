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
    private $log;

    /**
     * @return array
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param array $log
     *
     * @return $this
     */
    public function setLog($log)
    {
        $this->log = $log;
        return $this;
    }
}
