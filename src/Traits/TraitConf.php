<?php

declare(strict_types=1);

namespace SFQiao\Traits;
use \SFQiao\Conf;


/**
 * Trait TraitConf
 * @package SFQiao\Traits
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