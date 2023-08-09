<?php

declare(strict_types=1);

namespace SFQiao;

use SFQiao\Exception\QException;
use SFQiao\Order\Data;

/**
 * Class SFQiaoSDK
 * @package SFQiao
 */
class SFQiaoSDK extends AbstractGateway
{

    public function setConf(array $conf): SFQiaoSDK
    {
        foreach ($conf as $k => $v){
            if (property_exists($this, $k) && $v) $this->$k = $v;
            if(! $v) throw new QException("the conf property {$k} is empty.");
        }

        return $this;
    }

    /**
     * @param Data $data
     * @throws Exception\QException
     */
    private function preRequestProcess(Data $data):void
    {
        $xmlStr = $data->getXmlStr();
        $verifyCode = Tool::getVerifyCode($xmlStr, $this->checkWord);
        $postData = ['xml' => $xmlStr, 'verifyCode' => $verifyCode];
        $this->request($postData);
    }

    /**
     * 订单下单结果查询
     * @param \SFQiao\Order\OrderSearchService $data 订单下单结果查询数据模型
     * @param bool $resultWithInitInfo 返回数据是否包含原始请求和响应数据
     * @return array|null
     * @throws Exception\QException
     */
    public function quickQueryOrderResult(\SFQiao\Order\OrderSearchService $data, bool $resultWithInitInfo = false): ?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (
            isset($result['data']) && $result['data'] &&
            isset($result['data']['OrderResponse']) && $result['data']['OrderResponse'] &&
            isset($result['data']['OrderResponse']['@attributes']) && $result['data']['OrderResponse']['@attributes']
        ) {
            $result['data'] = $result['data']['OrderResponse']['@attributes'];
        }
        return $result;
    }

    /**
     * 快递路由查询
     * @param Order\RouteService $data
     * @param bool $resultWithInitInfo
     * @return array|null
     * @throws Exception\QException
     */
    public function quickQueryOrderRoute(\SFQiao\Order\RouteService $data, bool $resultWithInitInfo = false):?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (
            isset($result['data']) && $result['data'] &&
            isset($result['data']['OrderResponse']) && $result['data']['OrderResponse'] &&
            isset($result['data']['OrderResponse']['@attributes']) && $result['data']['OrderResponse']['@attributes']
        ) {
            $result['data'] = $result['data']['OrderResponse']['@attributes'];
        }
        return $result;
    }

    /**
     * 筛选订单
     * @param Order\OrderFilterService $data
     * @param bool $resultWithInitInfo
     * @return array|null
     * @throws Exception\QException
     */
    public function quickFilterOrder(\SFQiao\Order\OrderFilterService $data, bool $resultWithInitInfo = false):?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (
            isset($result['data']) && $result['data'] &&
            isset($result['data']['OrderFilterResponse']) && $result['data']['OrderFilterResponse'] &&
            isset($result['data']['OrderFilterResponse']['@attributes']) && $result['data']['OrderFilterResponse']['@attributes']
        ) {
            $result['data'] = $result['data']['OrderFilterResponse']['@attributes'];
        }
        return $result;
    }

    /**
     * 生成子单号
     * @param Order\OrderZDService $data
     * @param bool $resultWithInitInfo
     * @return array|null
     * @throws Exception\QException
     */
    public function quickApplySubOrderNo(\SFQiao\Order\OrderZDService $data, bool $resultWithInitInfo = false):?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (
            isset($result['data']) && $result['data'] &&
            isset($result['data']['OrderZDResponse']) && $result['data']['OrderZDResponse'] &&
            isset($result['data']['OrderZDResponse']['@attributes']) && $result['data']['OrderZDResponse']['@attributes']
        ) {
            $result['data'] = $result['data']['OrderZDResponse']['@attributes'];
        }
        return $result;
    }

    /**
     * 确认或取消订单
     * @param Order\OrderConfirmService $data
     * @param bool $resultWithInitInfo
     * @return array|null
     * @throws Exception\QException
     */
    public function quickConfirmOrCancelOrder(\SFQiao\Order\OrderConfirmService $data, bool $resultWithInitInfo = false):?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (
            isset($result['data']) && $result['data'] &&
            isset($result['data']['OrderConfirmResponse']) && $result['data']['OrderConfirmResponse'] &&
            isset($result['data']['OrderConfirmResponse']['@attributes']) && $result['data']['OrderConfirmResponse']['@attributes']
        ) {
            $result['data'] = $result['data']['OrderConfirmResponse']['@attributes'];
        }
        return $result;
    }

    /**
     * 下单
     * @param Order\OrderService $data
     * @param bool $resultWithInitInfo
     * @return array|null
     * @throws Exception\QException
     */
    public function quickOrderMainland(\SFQiao\Order\OrderService $data, bool $resultWithInitInfo = false):?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (
            isset($result['data']) &&
            $result['data'] &&
            isset($result['data']['OrderResponse']) &&
            $result['data']['OrderResponse'] &&
            isset($result['data']['OrderResponse']['rls_info']) &&
            $result['data']['OrderResponse']['rls_info'] &&
            isset($result['data']['OrderResponse']['rls_info']['rls_detail']) &&
            $result['data']['OrderResponse']['rls_info']['rls_detail'] &&
            isset($result['data']['OrderResponse']['rls_info']['rls_detail']['@attributes']) &&
            $result['data']['OrderResponse']['rls_info']['rls_detail']['@attributes']
        ) {
            $result['data'] = $result['data']['OrderResponse']['rls_info']['rls_detail']['@attributes'];
        }
        return $result;
    }

    /**
     * 下单(国际件)
     * @param Order\OrderServiceCrossBorder $data
     * @param bool $resultWithInitInfo
     * @return array|null
     * @throws Exception\QException
     */
    public function quickOrderCrossBorder(\SFQiao\Order\OrderServiceCrossBorder $data, bool $resultWithInitInfo = false):?array
    {
        $this->preRequestProcess($data);
        $result = $this->getResult($resultWithInitInfo);
        if (! isset($result['data']) || ! $result['data']) {
            return null;
        }
        return $result;
    }
}