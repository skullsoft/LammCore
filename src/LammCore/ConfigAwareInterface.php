<?php

namespace LammCore;

interface ConfigAwareInterface
{

    public function setConfig($config);
    public function setSession($session);

}
