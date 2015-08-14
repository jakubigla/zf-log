<?php

namespace QEngineLog\Log\Processor;

use Zend\Log\Processor\ProcessorInterface;

/**
 * Class RequestId
 *
 * @package QEngineLog\Log\Processor
 * @author Jakub Igla <jakub.igla@valtech.co.uk>
 */
class RequestId implements ProcessorInterface
{
    /**
     * Request identifier
     *
     * @var string
     */
    protected $identifier;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Adds an identifier for the request to the log, unless one has already been set.
     *
     * This enables to filter the log for messages belonging to a specific request
     *
     * @param array $event event data
     * @return array event data
     */
    public function process(array $event)
    {
        if (isset($event['extra']['requestId'])) {
            return $event;
        }

        if (!isset($event['extra'])) {
            $event['extra'] = [];
        }

        $event['extra']['requestId'] = $this->identifier;
        return $event;
    }
}
