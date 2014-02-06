<?php

namespace LammCore\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @author L. Mayta <slovacus@gmail.com>
 */
class AbstractModel implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    /**
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     *
     * @return \Zend\EventManager\EventManager
     */
    public function getEvent()
    {
        return $this->getServiceLocator()->get('Application')->getEventManager();
    }

}
