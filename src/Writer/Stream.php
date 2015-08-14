<?php

namespace QEngineLog\Log\Writer;

use Zend\Log\Exception;
use Zend\Log\Writer as ZendWriter;

/**
 * Class Stream
 *
 * @package QEngineLog\Log\Writer
 * @author  Jakub Igla <jakub.igla@valtech.co.uk>
 */
class Stream extends ZendWriter\Stream
{
    const ENV_LOG_PATH = 'LOG_PATH';

    /**
     * Constructor
     *
     * @param  string|resource|array|\Traversable $streamOrUrl Stream or URL to open as a stream
     * @param  string|null $mode Mode, only applicable if a URL is given
     * @param  null|string $logSeparator Log separator string
     * @return Stream
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     */
    public function __construct($streamOrUrl, $mode = null, $logSeparator = null)
    {
        if (is_array($streamOrUrl)) {
            $streamOrUrl['stream'] = getenv(self::ENV_LOG_PATH) ?: $streamOrUrl['stream'];
        } elseif (is_string($streamOrUrl)) {
            $streamOrUrl = getenv(self::ENV_LOG_PATH) ?: $streamOrUrl;
        }

        parent::__construct($streamOrUrl, $mode, $logSeparator);
    }
}
