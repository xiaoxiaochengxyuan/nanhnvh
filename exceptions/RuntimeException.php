<?php
namespace app\exceptions;
class RuntimeException extends \RuntimeException {
    /**
     * 抛出异常
     * @param string $msg
     * @throws RuntimeException
     */
    public static function throwException($msg) {
        throw new self($msg, RUNTIME_EXCEPTION_ERROR_CODE, null);
    }
}