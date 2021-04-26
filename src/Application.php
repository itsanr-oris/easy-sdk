<?php /** @noinspection PhpUndefinedClassInspection */

namespace Foris\Easy\Sdk\Skeleton;

/**
 * Class Application
 */
class Application extends \Foris\Easy\Sdk\Application
{
    /**
     * Merge sdk configuration.
     *
     * @param array $config
     * @return \Foris\Easy\Sdk\Application
     */
    public function mergeConfig($config = [])
    {
        /**
         * Merge logger configuration.
         */
        if (isset($config['logger'])) {
            $this->config()->mergeConfig($config['logger'], 'logger.channels.daily');
            unset($config['logger']);
        }

        return parent::mergeConfig($config);
    }
}
