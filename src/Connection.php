<?php
/**
 * Created by PhpStorm.
 * User: Yarmaliuk Mikhail
 * Date: 13.08.18
 * Time: 17:11
 */

namespace Kakadu\Yii2RfidReader;

use yii\base\Component;
use yii\httpclient\Client;
use yii\httpclient\Request;

/**
 * Class    Connection
 * @package Kakadu\Yii2RfidReader
 * @author  Yarmaliuk Mikhail
 * @version 1.0
 */
class Connection extends Component
{
    /**
     * @var string
     */
    public $host = 'http://127.0.0.1';

    /**
     * @var int
     */
    public $port = 9901;

    /**
     * @var Client
     */
    private $_client;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        $url = $this->host;

        if (!empty($this->port)) {
            $url .= ':' . $this->port;
        }

        $this->_client = new Client([
            'baseUrl' => $url,
        ]);

        parent::init();
    }

    /**
     * Create api request
     *
     * @return Request
     */
    protected function createRequest(): Request
    {
        return $this->_client->createRequest()
            ->setOptions([
                'userAgent' => 'Kakadu Http Client 1.0',
                'timeout'   => 10,
            ]);
    }

    /**
     * Get rfid tags
     *
     * @return Tag[]
     */
    public function getTags(): array
    {
        try {
            $response = $this->createRequest()
                ->setUrl('/tags')
                ->setMethod('GET')
                ->send();
        } catch (\Exception $e) {
            return [];
        }

        $tags = [];

        if ($response->isOk) {
            foreach ($response->data as $data) {
                if (!empty($data['epcId'])) {
                    $tags[] = new Tag($data);
                }
            }
        }

        return $tags;
    }

    /**
     * Delete tags (clear read list)
     *
     * @return bool
     */
    public function deleteTags(): bool
    {
        try {
            $response = $this->createRequest()
                ->setUrl('/tags/delete-all')
                ->setMethod('DELETE')
                ->send();

            if ($response->isOk) {
                return true;
            }
        } catch (\Exception $e) {
        }

        return false;
    }

    /**
     * Get reader data
     *
     * @return Reader
     */
    public function getReader(): Reader
    {
        $reader = new Reader();

        $reader->setConnection($this);

        try {
            $response = $this->createRequest()
                ->setUrl('/reader/status')
                ->setMethod('GET')
                ->send();

            if ($response->isOk) {
                $reader->setInventoryStatus((bool) $response->data['inventory'] ?? false);
                $reader->setReaderStatus((bool) $response->data['reader'] ?? false);
            }
        } catch (\Exception $e) {
        }

        return $reader;
    }

    /**
     * Get reeader error message
     *
     * @return null|string
     */
    public function getErrorMessage(): ?string
    {
        try {
            $response = $this->createRequest()
                ->setUrl('/reader/error-message')
                ->setMethod('GET')
                ->send();

            if ($response->isOk) {
                return $response->data['errorMessage'] ?? NULL;
            }
        } catch (\Exception $e) {
        }

        return NULL;
    }

    /**
     * Restart inventory
     *
     * @return ApiResponse
     */
    public function inventoryRestart(): ApiResponse
    {
        $apiResponse = new ApiResponse();

        try {
            $response = $this->createRequest()
                ->setUrl('/reader/inventory-restart')
                ->setMethod('POST')
                ->send();

            if ($response->isOk) {
                $apiResponse->setMessage($response->data['errorMessage'] ?? NULL);
                $apiResponse->setStatus($response->data['status'] ?? false);
            }
        } catch (\Exception $e) {
        }

        return $apiResponse;
    }

    /**
     * Restart connection
     *
     * @return ApiResponse
     */
    public function connectionRestart(): ApiResponse
    {
        $apiResponse = new ApiResponse();

        try {
            $response = $this->createRequest()
                ->setUrl('/reader/connection-restart')
                ->setMethod('POST')
                ->send();

            if ($response->isOk) {
                $apiResponse->setMessage($response->data['errorMessage'] ?? NULL);
                $apiResponse->setStatus($response->data['status'] ?? false);
            }
        } catch (\Exception $e) {
        }

        return $apiResponse;
    }

    /**
     * Disconnect from reader
     *
     * @return ApiResponse
     */
    public function disconnect(): ApiResponse
    {
        $apiResponse = new ApiResponse();

        try {
            $response = $this->createRequest()
                ->setUrl('/reader/connection-stop')
                ->setMethod('POST')
                ->send();

            if ($response->isOk) {
                $apiResponse->setMessage($response->data['errorMessage'] ?? NULL);
                $apiResponse->setStatus($response->data['status'] ?? false);
            }
        } catch (\Exception $e) {
        }

        return $apiResponse;
    }
}