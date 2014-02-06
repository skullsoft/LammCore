<?php

namespace LammCore\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    LammCore\ConfigAwareInterface;

class ActionController extends AbstractActionController
    implements ConfigAwareInterface
{

    /**
     *
     * @var array
     */
    protected $config;
    protected $session;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

}
