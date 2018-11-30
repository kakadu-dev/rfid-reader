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
     * Get rfid tags and queue size
     *
     * @return array
     */
    public function getTagsAndQueue(): array
    {
        try {
            $response = $this->createRequest()
                ->setUrl('/tags/list-wait-tags')
                ->setMethod('GET')
                ->send();
        } catch (\Exception $e) {
            return [];
        }

        $tags      = [];
        $queueSize = 0;

        if ($response->isOk) {
            $queueSize = (int) ($response->data['queue'] ?? 0);

            foreach ($response->data['tags'] as $tag) {
                if (!empty($tag['epcId'])) {
                    $tags[] = new Tag($tag);
                }
            }
        }

        return [
            'queueSize' => $queueSize,
            'tags'      => $tags,
        ];
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
                $reader->setTagsCount((int) $response->data['tagsCount'] ?? 0);
                $reader->setSynMessageQueue((int) $response->data['SynMessageQueue'] ?? 0);
                $reader->setProtocolDecoderOutputQueue((int) $response->data['ProtocolDecoderOutputQueue'] ?? 0);
                $reader->setExecutorFilterQueue((int) $response->data['ExecutorFilterQueue'] ?? 0);
                $reader->setConnectionAttemptEventQueue((int) $response->data['ConnectionAttemptEventQueue'] ?? 0);
                $reader->setErrorMessage($response->data['errorMessage'] ?? null);
            }
        } catch (\Exception $e) {
        }

        return $reader;
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
                $apiResponse->setMessage($response->data['errorMessage'] ?? null);
                $apiResponse->setStatus($response->data['status'] ?? false);
            }
        } catch (\Exception $e) {
        }

        return $apiResponse;
    }

    /**
     * Stop inventory
     *
     * @return ApiResponse
     */
    public function inventoryStop(): ApiResponse
    {
        $apiResponse = new ApiResponse();

        try {
            $response = $this->createRequest()
                ->setUrl('/reader/inventory-stop')
                ->setMethod('POST')
                ->send();

            if ($response->isOk) {
                $apiResponse->setMessage($response->data['errorMessage'] ?? null);
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
                $apiResponse->setMessage($response->data['errorMessage'] ?? null);
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
                $apiResponse->setMessage($response->data['errorMessage'] ?? null);
                $apiResponse->setStatus($response->data['status'] ?? false);
            }
        } catch (\Exception $e) {
        }

        return $apiResponse;
    }


}