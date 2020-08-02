<?php

namespace Foris\Easy\Sdk\Skeleton\Hello;

use Foris\Easy\Sdk\Component;

/**
 * Class Hello
 */
class Hello extends Component
{
    /**
     * Return a hello message.
     *
     * @return string
     */
    public function hello()
    {
        $this->app()->get('logger')->debug('aaa');
        return "Hello, easy sdk framework.";
    }
}
