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
     * @var string
     */
    public $userData;

    /**
     * @var int
     */
    public $createdAt;

    /**
     * @var int
     */
    public $updatedAt;

    /**
     * Get decoded EPC id
     *
     * @return string
     */
    public function getDecodedEpc(): string
    {
        return $this->hex2str($this->epcId);
    }

    /**
     * Get decoded user data
     *
     * @return string
     */
    public function getDecodedUserData(): string
    {
        return $this->hex2str($this->userData);
    }

    /**
     * Convert HEX to ASCII
     *
     * @param string $hex
     *
     * @return string
     */
    private function hex2str($hex): string
    {
        $str = '';
        for ($i = 0; $i < strlen($hex); $i += 2) $str .= chr(hexdec(substr($hex, $i, 2)));

        return $str;
    }
}