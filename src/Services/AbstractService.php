<?php

namespace ConsulConfigManager\Proxmox\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use ConsulConfigManager\Proxmox\Helpers\TokenBuilderHelper;

/**
 * Class AbstractService
 * @package ConsulConfigManager\Proxmox\Services
 */
abstract class AbstractService
{
    /**
     * HTTP Client instance
     * @var PendingRequest
     */
    private PendingRequest $client;

    /**
     * AbstractService constructor.
     * @return void
     */
    public function __construct()
    {
        $this->initializeClient();
    }

    /**
     * Get instance of HTTP Client
     * @return PendingRequest
     */
    public function client(): PendingRequest
    {
        return $this->client;
    }

    /**
     * Send get request to the server
     * @param string $path
     * @param array $query
     * @return mixed
     */
    public function sendGetRequest(string $path, array $query = []): mixed
    {
        $response = $this->client()->get($path, $query);
        // TODO: Handle errors

        return $response->json('data');
    }

    /**
     * Send POST request to the server
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function sendPostRequest(string $path, array $data = []): mixed
    {
        $response = $this->client()->post($path, $data);
        // TODO: Handle errors

        return $response->json('data');
    }

    /**
     * Initialize client
     * @return void
     */
    private function initializeClient(): void
    {
        $activeConnection = $this->getActiveConnection();
        $scheme = Arr::get($activeConnection, 'scheme', 'https');
        $host = Arr::get($activeConnection, 'host', '127.0.0.1');
        $port = Arr::get($activeConnection, 'port', 8006);

        $tokenPrefix = config('domain.proxmox.access_token.prefix', 'PVEAPIToken');
        $tokenValue = TokenBuilderHelper::build();

        $this->client = Http::baseUrl(sprintf(
            '%s://%s:%d/api2/json',
            $scheme,
            $host,
            $port,
        ))->withToken(
            $tokenValue,
            $tokenPrefix,
        )->withOptions([
            'verify'        =>  false,
        ])->timeout(15);
    }

    /**
     * Get currently active connection
     * @return array
     */
    private function getActiveConnection(): array
    {
        $connectionName = config('domain.proxmox.default', 'proxmox');
        $connectionsList = config('domain.proxmox.connections', [
            'proxmox'       =>  [
                'scheme'    =>  'https',
                'host'      =>  '127.0.0.1',
                'port'      =>  8006,
            ],
        ]);

        return $connectionsList[$connectionName];
    }
}
