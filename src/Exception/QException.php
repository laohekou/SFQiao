<?php

declare(strict_types=1);
namespace SFQiao\Exception;

/**
 * Class QException
 * @package SFQiao\Exception
 */
class QException extends \Exception
{
    private $tagPrefix = 'SFQiao';

    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct('['.$this->tagPrefix.']'.$message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->file.'@'.$this->line.':'.$this->message;
    }
}