<?php

namespace Trademachines\RiemannLogger\Tests;

use Trademachines\RiemannLogger\RiemannLoggerInterface;
use Trademachines\RiemannLogger\TaggedRiemannLogger;

class TaggedRiemannLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testDontTouchNonArrayTags()
    {
        $delegate = $this->getRiemannLogger();
        $logger   = new TaggedRiemannLogger(['bar'], $delegate->reveal());
        $logger->log(['tags' => 'foo']);

        $delegate->log(['tags' => 'foo'], [])->shouldHaveBeenCalled();
    }
    
    public function testCreateTagsIfNotPresent()
    {
        $delegate = $this->getRiemannLogger();
        $logger   = new TaggedRiemannLogger(['foo', 'bar'], $delegate->reveal());
        $logger->log([]);

        $delegate->log(['tags' => ['foo', 'bar']], [])->shouldHaveBeenCalled();
    }

    public function testMergeTagsIfPresent()
    {
        $delegate = $this->getRiemannLogger();
        $logger   = new TaggedRiemannLogger(['foo', 'bar'], $delegate->reveal());
        $logger->log(['tags' => ['baz']]);

        $delegate->log(['tags' => ['baz', 'foo', 'bar']], [])->shouldHaveBeenCalled();

    }

    private function getRiemannLogger()
    {
        return $this->prophesize(RiemannLoggerInterface::class);
    }
}
