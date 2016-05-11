<?php

namespace Trademachines\RiemannLogger;

class TaggedRiemannLogger implements RiemannLoggerInterface
{
    /** @var array */
    protected $tags;

    /** @var RiemannLoggerInterface */
    protected $delegate;

    /**
     * TaggedRiemannLogger constructor.
     *
     * @param array                  $tags
     * @param RiemannLoggerInterface $delegate
     */
    public function __construct(array $tags, RiemannLoggerInterface $delegate)
    {
        $this->tags     = $tags;
        $this->delegate = $delegate;
    }

    /** {@inheritdoc} **/
    public function log(array $data, array $attributes = [])
    {
        if (!array_key_exists('tags', $data)) {
            $data['tags'] = $this->tags;
        } elseif (is_array($data['tags'])) {
            $data['tags'] = array_merge($data['tags'], $this->tags);
        }

        $this->delegate->log($data, $attributes);
    }
}
