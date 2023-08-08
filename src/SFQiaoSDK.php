<?php

declare(strict_types=1);
namespace SFQiao;
use GuzzleHttp\Client;
use SFQiao\Order\Data;
use SFQiao\Traits\TraitConf;
use SFQiao\Traits\TraitResult;

/**
 * Class SFQiaoSDK
 * @package SFQiao
 */
class SFQiaoSDK
{
    use TraitConf, TraitResult;

    public function __construct()
    {
        $this->zero();
    }

    private function zero():void
    {
        $this->initConf();
        $this->initResult();
    }

    private function request(?array $postData):void
    {
        $client = new Client();
        $result = $client->request('POST', $this->conf()->requestUri, [
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                'charset' => 'utf-8'
            ],
            'form_params' => $postData
        ]);
        $this->result()->setInitRequest($postData);
        $this->result()->setResponse($result);
    }

    /**
     * @param Data $data
     * @throws Exception\QException
     */
    private function preRequestProcess(Data $data):void
    {
        $data->setConf($this->conf);
        $this->conf()->validate();
        $xmlStr = $data->getXmlStr();
        $verifyCode = Tool::getVerifyCode($xmlStr, $this->conf()->checkWord);
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
        $result = $this->result()->getResult($resultWithInitInfo);
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
        $result = $this->result()->getResult($resultWithInitInfo);
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
        $result = $this->result()->getResult($resultWithInitInfo);
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
        $result = $this->result()->getResult($resultWithInitInfo);
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
        $result = $this->result()->getResult($resultWithInitInfo);
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
        $result = $this->result()->getResult($resultWithInitInfo);
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
        $result = $this->result()->getResult($resultWithInitInfo);
        if (! isset($result['data']) || ! $result['data']) {
            return null;
        }
        return $result;
    }
}