<?php
/**
 * Created by PhpStorm.
 * User: Yarmaliuk Mikhail
 * Date: 13.08.18
 * Time: 17:11
 */

namespace Kakadu\Yii2RfidReader;

use yii\base\Model;

/**
 * Class    Reader
 * @package Kakadu\Yii2RfidReade
 * @author  Yarmaliuk Mikhail
 * @version 1.0
 */
class Reader extends Model
{
    /**
     * @var bool
     */
    private $readerStatus = false;

    /**
     * @var bool
     */
    private $inventoryStatus = false;

    /**
     * @var int
     */
    private $tagsCount = 0;

    /**
     * @var int
     */
    private $synMessageQueue = 0;

    /**
     * @var int
     */
    private $protocolDecoderOutputQueue = 0;

    /**
     * @var int
     */
    private $executorFilterQueue = 0;

    /**
     * @var int
     */
    private $connectionAttemptEventQueue = 0;

    /**
     * @var null|string
     */
    private $errorMessage;

    /**
     * @var Connection
     */
    private $_connection;

    /**
     * @return bool
     */
    public function isInventoryStatus(): bool
    {
        return $this->inventoryStatus;
    }

    /**
     * @param bool $inventoryStatus
     */
    public function setInventoryStatus(bool $inventoryStatus): void
    {
        $this->inventoryStatus = $inventoryStatus;
    }

    /**
     * @return bool
     */
    public function isReaderStatus(): bool
    {
        return $this->readerStatus;
    }

    /**
     * @param bool $readerStatus
     */
    public function setReaderStatus(bool $readerStatus): void
    {
        $this->readerStatus = $readerStatus;
    }

    /**
     * @param Connection $connection
     */
    public function setConnection(Connection $connection): void
    {
        $this->_connection = $connection;
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->_connection;
    }

    /**
     * @return int
     */
    public function getTagsCount(): int
    {
        return $this->tagsCount;
    }

    /**
     * @param int $tagsCount
     */
    public function setTagsCount(int $tagsCount): void
    {
        $this->tagsCount = $tagsCount;
    }

    /**
     * @return int
     */
    public function getSynMessageQueue(): int
    {
        return $this->synMessageQueue;
    }

    /**
     * @param int $synMessageQueue
     */
    public function setSynMessageQueue(int $synMessageQueue): void
    {
        $this->synMessageQueue = $synMessageQueue;
    }

    /**
     * @return int
     */
    public function getProtocolDecoderOutputQueue(): int
    {
        return $this->protocolDecoderOutputQueue;
    }

    /**
     * @param int $protocolDecoderOutputQueue
     */
    public function setProtocolDecoderOutputQueue(int $protocolDecoderOutputQueue): void
    {
        $this->protocolDecoderOutputQueue = $protocolDecoderOutputQueue;
    }

    /**
     * @return int
     */
    public function getExecutorFilterQueue(): int
    {
        return $this->executorFilterQueue;
    }

    /**
     * @param int $executorFilterQueue
     */
    public function setExecutorFilterQueue(int $executorFilterQueue): void
    {
        $this->executorFilterQueue = $executorFilterQueue;
    }

    /**
     * @return int
     */
    public function getConnectionAttemptEventQueue(): int
    {
        return $this->connectionAttemptEventQueue;
    }

    /**
     * @param int $connectionAttemptEventQueue
     */
    public function setConnectionAttemptEventQueue(int $connectionAttemptEventQueue): void
    {
        $this->connectionAttemptEventQueue = $connectionAttemptEventQueue;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param null|string $errorMessage
     */
    public function setErrorMessage(?string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}