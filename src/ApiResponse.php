<?php
/**
 * Created by PhpStorm.
 * User: Yarmaliuk Mikhail
 * Date: 28.08.18
 * Time: 12:52
 */

namespace Kakadu\Yii2RfidReader;

use yii\base\Model;

/**
 * Class    ApiResponse
 * @package Kakadu\Yii2RfidReader
 * @author  Yarmaliuk Mikhail
 * @version 1.0
 */
class ApiResponse extends Model
{
    /**
     * @var bool
     */
    private $_status;

    /**
     * @var string|null
     */
    private $_message;

    /**
     * If response status has true
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->_status;
    }

    /**
     * Response message
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->_message;
    }

    /**
     * Set response status
     *
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->_status = $status;
    }

    /**
     * Set response message
     *
     * @param null|string $message
     */
    public function setMessage(?string $message): void
    {
        $this->_message = $message;
    }
}