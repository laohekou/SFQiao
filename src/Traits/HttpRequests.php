<?php

namespace SFQiao\Traits;

use GuzzleHttp\Client;

trait HttpRequests
{

    /**
     * curl
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function request(array $data)
    {
        try {
            $resp = $this->app->http
                ->post($this->app->getUrl() . $this->relativeUrl, $data)
                ->getBody();
            if ($resp) {
                return $this->parseResult($resp);
            }
            return [];
        } catch (\Throwable $e) {
            throw new \Exception('杉德接口请求失败：' . $e->getMessage());
        }
    }
}