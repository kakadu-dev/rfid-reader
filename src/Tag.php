<?php
/**
 * Created by PhpStorm.
 * User: Yarmaliuk Mikhail
 * Date: 13.08.18
 * Time: 17:15
 */

namespace Kakadu\Yii2RfidReader;

use yii\base\Model;

/**
 * Class    Tag
 * @package Kakadu\Yii2RfidReader
 * @author  Yarmaliuk Mikhail
 * @version 1.0
 */
class Tag extends Model
{
    /**
     * @var string
     */
    public $epcId;

    /**
     * @var int
     */
    public $rssi;

    /**
     * @var int
     */
    public $seenCount;

    /**
     * @var int
     */
    public $antenaId;

    /**
     * @var int
     */
    public $createdAt;

    /**
     * @var int
     */
    public $updatedAt;
}