<?php

declare(strict_types=1);

namespace SFQiao\Order;


/**
 * Class OrderService
 * @package SFQiao\Order
 */
class OrderServiceCrossBorder extends Data
{
    /** @var string 服务映射键名 */
    public $serviceNameMapKey = 'OrderService';

    /** @var string 客户订单号 */
    public $orderId = "";
    /** @var string 顺丰母运单号 如果dealtype=1,必填 */
    public $mailNo = '';
    /** @var string 是否要求返回顺丰运单号 1-要求 其它为不要求 */
    public $isGenBillNo = '';
    /** @var OrderServiceSender|null 寄件人数据模型 */
    public $sender = null;
    /** @var OrderServiceReceiver|null 收件人数据模型 */
    public $receiver = null;
    /** @var string 顺丰月结卡号 */
    public $cusTid = '';
    /**
     * @var int 付款方式
     * 1-寄方付 2-收方付 3-第三方付
     * 进出口件必填
     */
    public $payMethod = 1;
    /** @var string 快件产品编码 */
    public $expressType = '';
    /**
     * @var int 包裹数
     * 一个包裹对应一个运单号,如果是大于1个包裹,则返回则按照子母件的方式返回母运单号和子运单号
     */
    public $parcelQuantity = 1;
    /**
     * @var int 客户订单货物总长,单位厘米,精确到小数点后3位,包含子母件
     */
    public $cargoLength = 0;
    /**
     * @var int 客户订单货物总宽,单位厘米,精确到小数点后3位,包含子母件
     */
    public $cargoWidth = 0;
    /**
     * @var int 客户订单货物总高,单位厘米,精确到小数点后3位,包含子母件
     */
    public $cargoHeight = '';
    /**
     * @var int 订单货物总体积
     * 单位立方厘米,精确到小数点后3位,会用于计抛(是否计抛具体商务沟通中双方约定)
     */
    public $volume = 0;

    /**
     * @var int 订单货物总重量,包含子母件,单位千克,精确到小数点后3位,
     * 如果提供此值,必须>0
     */
    public $cargoTotalWeight = 0;
    /** @var int 客户订单货物总声明价值,包含子母件,精确到小数点后3位。如果是跨境件,则必填 */
    public $declaredValue = 0;
    /**
     * @var string 货物声明价值币别
     * 如果目的地是中国大陆的,则默认为CNY,否则默认为USD
     * 跨境件报关需要填写
     * CNY: 人民币 HKD: 港币 USD: 美元 NTD: 新台币 RUB: 卢布 EUR: 欧元 MOP: 澳门元 SGD: 新元 JPY: 日元 KRW: 韩元 MYR: 马币 VND: 越南盾 THB: 泰铢 AUD: 澳大利亚元 MNT: 图格里克
     */
    public $declaredValueCurrency = '';
    /** @var string 报关批次 */
    public $customsBatchs = '';
    /**
     * @var string 要求上门取件开始时间
     * 格式: YYYY-MM-DD HH24:MM:SS
     */
    public $sendStartTime = '';
    /** @var int 是否要求通过手持终端通知顺丰收派员收件 1-要求 其它为不要求 */
    public $isDoCall =0;
    /**
     * @var string 是否要求签回单号
     * 1-要求(丰密签回单必传routelabelForReturn/routelabelService)
     * 其它为不要求
     */
    public $needReturnTrackingNo = '';
    /** @var string 顺丰签回单服务运单号 */
    public $returnTracking = '';
    /** @var string 收件人税号 */
    public $dTaxNo ='';
    /** @var string 税金付款方式 1-寄付 2-到付 */
    public $taxPayType = '';
    /** @var string 税金结算账号 */
    public $taxSetAccounts = '';
    /** @var string 电商原始订单号 */
    public $originalNumber = '';
    /** @var string 支付工具 */
    public $paymentTool = '';
    /** @var string 支付号码 */
    public $paymentNumber = '';
    /** @var string 商品编号 */
    public $goodsCode = '';
    /** @var string 头程运单号 */
    public $inProcessWaybillNo = '';
    /** @var string 货物品牌 */
    public $brand = '';
    /** @var string 货物规格型号 */
    public $specifications = '';
    /**
     * @var int 温度范围类型
     * 当express_type为12医药温控件时必填
     * 1-冷藏 3-冷冻
     */
    public $tempRange = 0;
    /** @var string 客户订单下单人姓名 */
    public $orderName = '';
    /** @var string 客户订单下单人证件类型 */
    public $orderCertType = '';
    /** @var string 客户订单下单人证件号 */
    public $orderCertNo = '';
    /** @var string 客户订单来源(对于平台类客户,如果需要在订单中区分订单来源,则可使用此字段) */
    public $orderSource = '';
    /**
     * @var string 业务模板编码
     * 业务模板指顺丰系统针对客户业务需求配置的一套接口处理逻辑
     * 一个接入编码可对应多个业务模板
     */
    public $template = '';
    /** @var string 备注 */
    public $remark = '';
    /**
     * @var int 快件自取
     * 1-客户同意快件自取 其他表示客户不同意快件自取
     */
    public $oneselfPickupFlg = 0;
    /** @var string 订单数据分发的系统编码 */
    public $dispatchSys = '';
    /** @var string 筛单特殊字段(此字段数据库中查询不到) */
    public $filterField = '';
    /** @var int 商品总净重 */
    public $totalNetWeight = 0;
    /** @var string 收方邮箱 */
    public $sendRemarkTwo = '';
    /**
     * @var string 特殊派送类型代码
     * 1-身份验证
     */
    public $specialDeliveryTypeCode = '';
    /** @var string 特殊派件具体表述 证件类型:证件后8位 */
    public $specialDeliveryValue = '';
    /** @var string 实名认证流水号 */
    public $realNameNum = '';
    /** @var string 商户订单号 */
    public $merchantPayOrde = '';
    /** @var int 签回单路由标签返回  1-查询,其他-不查询 */
    public $routeLabelForReturn = 0;
    /** @var int 路由标签查询服务 1-查询,其他-不查询 */
    public $routeLabelService = 0;
    /** @var string 寄件人税号 */
    public $jTaxNo = '';
    /** @var int 是否使用国家统一面单号 1-是, 0-否 */
    public $isUnifiedWaybillNo = 0;
    /** @var OrderServiceCargo[]|null 下单产品数据模型组 */
    public $cargoArr = null;


    public function __construct()
    {
        $this->sender = new OrderServiceSender();
        $this->receiver = new OrderServiceReceiver();
    }

    public function cargo():OrderServiceCargo
    {
        return new OrderServiceCargo();
    }

    public function getData():?array
    {
        return $this->loadPublicParams($this);
    }
}