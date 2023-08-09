<?php

declare(strict_types=1);

namespace SFQiao\Order;


/**
 * Class OSS 订单结果查询服务数据模型
 * @package SFQiao\Order
 */
class OrderSearchService extends Data
{
    /** @var string 服务映射键名 */
    protected $serviceNameMapKey = 'OrderSearchService';
    /** @var string 客户订单号 */
    public $orderId = '';
    /**
     * @var string 查询类型
     * 1. 正向单查询, 传入的orderid为正向定单号
     * 2. 退货单查询, 传入的orderid为退货原始订单号
     */
    public $searchType = '1';

    public function getData():?array
    {
        return $this->loadPublicParams($this);
    }
}