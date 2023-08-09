<?php

declare(strict_types=1);
namespace SFQiao;


/**
 * Class Tool
 * @package SFQiao
 */
class Tool
{
    /**
     * 生成验证码
     * @param string $xmlStr
     * @param string $checkWord
     * @return string
     */
    static public function getVerifyCode(string $xmlStr, string $checkWord):string
    {
        return base64_encode(md5($xmlStr . $checkWord, true));
    }

    /**
     * 递归创建xml主体内容
     * @param $data
     * @return string
     */
    static public function createXmlRecursion($data): string
    {
        $xml = '';
        foreach ($data as $key => $val) {
            $xmlScope = $key == 'body' ? '' : "<{$key}%s>";
            if (!is_array($val)) {
                return "<{$key}>{$val}</{$key}>";
            }
            if (is_string($key)) {
                $attrStr = '';
                if (isset($val['attributes']) && $val['attributes']) {
                    if (is_array(current($val['attributes']))) {
                        $xml = '';
                        foreach ($val['attributes'] as $v) {
                            $xmlScope = "<{$key}%s></{$key}>";
                            $attrStr = '';
                            foreach ($v as $ak => $av) {
                                $attrStr .= " $ak=\"{$av}\"";
                            }
                            $xmlScope = sprintf($xmlScope, $attrStr);
                            $xml .= $xmlScope;
                        }
                        return $xml;
                    } else {
                        foreach ($val['attributes'] as $ak => $av) {
                            $attrStr .= " $ak=\"{$av}\"";
                        }
                    }
                }
                $xmlScope = sprintf($xmlScope, $attrStr);
            }
            if (isset($val['body']) && $val['body']) {
                foreach ($val['body'] as $bk => $bv) {
                    $xmlScope .= self::createXmlRecursion([$bk => $bv]);
                }
            }
            $xmlScope .= $key == 'body' ? '' : "</{$key}>";
            $xml .= $xmlScope;
        }
        return $xml;
    }

    /**
     * xml字符串转数组
     * @param $xmlStr
     * @return array|null
     */
    static public function convertXml2Arr($xml):?array
    {
        if (\PHP_VERSION_ID < 80000) {
            \libxml_disable_entity_loader(true);
            return json_decode(json_encode(\simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true) ?: null;
        }else{
            $doc = new \DOMDocument();
            $doc->loadXML($xml);
            $xml = $doc->getElementsByTagName( 'xml' );
            $result = [];
            foreach( $xml as $val ){
                foreach($val->childNodes as $v){
                    if(!empty($v->tagName)){
                        $result[$v->tagName] = $v->nodeValue;
                    }
                }
            }
            return $result;
        }
    }

    static public function getRealName(string $keyName):string
    {
        return ConstSets::MAP_SPECIAL_FIELDS[$keyName]??self::smallCamel2Snake($keyName);
    }

    static public function smallCamel2Snake(string $str):string
    {
        return strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $str));
    }
}