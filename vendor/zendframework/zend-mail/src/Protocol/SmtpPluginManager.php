<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Mail\Protocol;

use Interop\Container\ContainerInterface;

/**
 * Plugin manager implementation for SMTP extensions.
 *
 * Enforces that SMTP extensions retrieved are instances of Smtp. Additionally,
 * it registers a number of default extensions available.
 */
class SmtpPluginManager implements ContainerInterface
{
    /**
     * Default set of plugins
     *
     * @var array
     */
    protected $plugins = [
        'crammd5' => 'Zend\Mail\Protocol\Smtp\Auth\Crammd5',
        'login'   => 'Zend\Mail\Protocol\Smtp\Auth\Login',
        'plain'   => 'Zend\Mail\Protocol\Smtp\Auth\Plain',
        'smtp'    => 'Zend\Mail\Protocol\Smtp',
    ];

    /**
     * Do we have the plugin?
     *
     * @param  string $id
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, $this->plugins);
    }
    /**
     * Retrieve the smtp plugin
     *
     * @param  string $id
     * @param  array $options
     * @return AbstractProtocol
     */
    public function get($id, array $options = null)
    {
        $class = $this->plugins[$id];
        return new $class($options);
    }
}
