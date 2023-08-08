<?php

declare(strict_types=1);

namespace SFQiao\Lib\Traits;
use \SFQiao\Lib\Conf;


/**
 * Trait TraitConf
 * @package SFQiao\Lib\Traits
 */
trait TraitConf
{
    protected $conf = null;

    public function initConf():void
    {
        $this->conf = new Conf();
    }

    public function setConf(Conf $conf):self
    {
        $this->conf = $conf;
        return $this;
    }

    public function conf():?Conf
    {
        return $this->conf;
    }
}