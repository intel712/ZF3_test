<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;
use Application\I18n\I18nListener;
use Application\View\LayoutListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\Config\ConfigInterface;

class Module
{
    const VERSION = '3.0.3-dev';

    /**
     * @param ModuleManagerInterface $manager
     */
    public function init(ModuleManagerInterface $manager)
    {
        if (!defined('APPLICATION_MODULE_ROOT')) {
            define('APPLICATION_MODULE_ROOT', realpath(__DIR__ . '/../'));
        }
    }

    /**
     * @param EventInterface $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        // get services
        $serviceManager = $e->getApplication()->getServiceManager();

        // add listeners
        $eventManager = $e->getApplication()->getEventManager();

        /** @var I18nListener $i18nListener */
        $i18nListener = $serviceManager->get(I18nListener::class);
        $i18nListener->attach($eventManager);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include APPLICATION_MODULE_ROOT
            . '/config/module.config.php';
    }
}
