<?php

namespace LammCore;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\Mvc\ModuleRouteListener,
    Zend\EventManager\Event;

class Module implements AutoloaderProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(Event $event)
    {
        $eventManager = $event->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $config = $event->getApplication()->getConfig();
        if(isset($config['core']['php']['settings'])) {
            $settings    = $config['core']['php']['settings'];
            if(is_array($settings)) {
                foreach($settings as $key => $value) {
                    ini_set($key, $value);
                }
            }
        }
    }

    /**
     *
     * @author L. Mayta <slovacus@gmail.com>
     *
     */
    public function getControllerConfig()
    {
        return array(
            'initializers' => array(
                function ($instance, $sm) {
                    if ($instance instanceof ConfigAwareInterface) {
                        $locator = $sm->getServiceLocator();
                        $config = $locator->get('Config');
                        $instance->setConfig($config);
                    }
                }
        )
        );
    }

}
