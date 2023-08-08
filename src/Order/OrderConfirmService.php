<?php

declare(strict_types=1);

namespace SFQiao\Order;


/**
 * Class OrderConfirmService
 * @package SFQiao\Order
 */
class OrderConfirmService extends Data
{
    /** @var string 服务映射键名 */
    public $serviceNameMapKey = 'OrderConfirmService';
    /** @var string 客户订单号, filter_type=2则必须提供 */
    public $orderId = '';
    /** @var string 顺丰母运单号 如果dealtype=1,必填 */
    public $mailNo = '';
    /**
     * @var string 客户订单操作标识
     * 1 确认 2 取消
     */
    public $dealType = '';
    /** @var string 报关批次 */
    public $customsBatchs = '';
    /** @var string 代理单号 */
    public $agentNo = '';
    /** @var string 收派员工号 */
    public $consignEmpCode = '';
    /** @var string 原寄地网点代码 */
    public $sourceZoneCode = '';
    /** @var string 头程运单号 */
    public $inProcessWaybillNo = '';
    /** @var OrderConfirmOption|null 订单确认可选参数数据模型 */
    public $orderConfirmOption = null;

    public function __construct()
    {
        $this->orderConfirmOption = new OrderConfirmOption();
    }

    public function getData():?array
    {
        return $this->loadPublicParams($this);
    }
}