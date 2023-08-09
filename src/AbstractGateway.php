<?php

declare(strict_types=1);

namespace SFQiao;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class AbstractGateway
 * @package SFQiao
 */
class AbstractGateway
{
    /** @var string 顾客编码 */
    public $customerCode = '';
    /** @var string 校验码 */
    public $checkWord = '';
    /** @var string 顺丰月结卡号 */
    public $cusTid = '';
    /** @var string 请求地址 */
    public $requestUri = ConstSets::REQUEST_URI_DEFAULT;

    private $result = [
        'state' => false,
        'msg' => '',
        'data' => null
    ];
    private $response = null;
    private $initRequestStr = '';
    private $initResponseStr = '';

    protected function request(array $postData):void
    {
        $client = new Client;
        $result = $client->request('POST', $this->requestUri, [
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                'charset' => 'utf-8'
            ],
            'form_params' => $postData
        ]);
        $this->setInitRequest($postData);
        $this->setResponse($result);
    }

    public function response():?Response
    {
        return $this->response;
    }

    public function setResponse(\Psr\Http\Message\ResponseInterface $response):Void
    {
        $this->response = $response;
    }

    public function setInitRequest(array $requestData):void
    {
        $this->initRequestStr = http_build_query($requestData);
    }

    /**
     * 获取结果
     * @param bool $withInitInfo 返回数据是否包含原始请求和响应数据
     * @return array
     */
    public function getResult(bool $withInitInfo = false): array
    {
        if ($this->response()->getStatusCode() != 200) {
            $this->result['msg'] = $this->response()->getReasonPhrase();
        } else {
            $this->initResponseStr = $this->response()->getBody()->getContents();
            $bodyContent = Tool::convertXml2Arr($this->initResponseStr);
            if (! $bodyContent) {
                $this->result['msg'] = '数据解析异常';
                $this->result['data'] = $this->response()->getBody()->getContents();
            } else {
                if ($bodyContent['Head'] == 'ERR') {
                    $this->result['msg'] = is_array($bodyContent['ERROR']) ? json_encode($bodyContent['ERROR'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : $bodyContent['ERROR'];
                } else {
                    $this->result['state'] = true;
                    $this->result['data'] = $bodyContent['Body'] ?? null;
                }
            }
        }
        if ($withInitInfo) {
            $this->result['initRequestStr'] = $this->initRequestStr;
            $this->result['initResponse'] = $this->initResponseStr;
        }
        return $this->result;
    }

}