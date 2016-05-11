<?php

namespace Trademachines\RiemannLogger;

/**
 * Interface for all loggers
 */
interface RiemannLoggerInterface
{
    /**
     * @param array $data
     * @param array $attributes
     */
    public function log(array $data, array $attributes = []);
}
