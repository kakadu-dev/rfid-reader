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
}