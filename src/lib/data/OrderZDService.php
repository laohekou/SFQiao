<?php

declare(strict_types=1);
namespace SFQiao\Lib\Data;


/**
 * Class OrderZDService
 * @package SFQiao\Lib\Data
 */
class OrderZDService extends Data
{
    /** @var string 服务映射键名 */
    public $serviceNameMapKey = 'OrderZDService';

    /** @var string 客户订单号 */
    public $orderId = '';
    /** @var int 新增加的包裹数,最大20 */
    public $parcelQuantity = 1;

    public function getData(): ?array
    {
        return $this->loadPublicParams($this);
    }
}