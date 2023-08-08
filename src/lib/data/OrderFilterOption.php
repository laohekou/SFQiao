<?php

declare(strict_types=1);

namespace SFQiao\Lib\Data;


/**
 * 订单筛选可选项数据模型
 * Class OrderFilterOption
 * @package SFQiao\Lib\Data
 */
class OrderFilterOption extends Data
{
    /** @var string 寄件方电话 */
    public $jTel = '';
    /** @var string 寄件人所在国家代码 */
    public $country = '';
    /** @var string 寄件方所在省份,必须是标准的省名称称谓 */
    public $province = '';
    /** @var string 寄件方所属城市名称,必须是标准的城市称谓 */
    public $city = '';
    /** @var string 寄件人所在县/区,必须是标准的县/区称谓 */
    public $county = '';
    /** @var string 到件方国家 */
    public $dCountry = '';
    /** @var string 到件方所在省份,必须是标准的省名称称谓 */
    public $dProvince = '';
    /** @var string 到件方所属城市名称,必须是标准的城市称谓 */
    public $dCity = '';
    /** @var string 到件方所在县/区,必须是标准的县/区称谓 */
    public $dCounty = '';
    /** @var string 寄件方详细地址,包括省市区 */
    public $jAddress = '';
    /** @var string 到件方电话 */
    public $dTel = '';
    /** @var string 结账号,用于在人工筛单时,筛单人员识别客户使用 */
    public $jCusTid = '';

    public function getData(): ?array
    {
        return $this->loadOptionParams($this);
    }
}