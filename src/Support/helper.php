<?php

if (!function_exists('sf_qiao')) {
    function sf_qiao(array $conf)
    {
        return (new \SFQiao\SFQiaoSDK)->setConf($conf);
    }
}

if (!function_exists('sfqiao')) {
    function sfqiao(array $conf)
    {
        return \Hyperf\Utils\ApplicationContext::getContainer()->get(\SFQiao\SFQiaoSDK::class)->setConf($conf);
    }
}