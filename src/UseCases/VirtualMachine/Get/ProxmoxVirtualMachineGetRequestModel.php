<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get;

use Illuminate\Http\Request;

/**
 * Class ProxmoxVirtualMachineGetRequestModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get
 */
class ProxmoxVirtualMachineGetRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Machine node
     * @var string
     */
    private string $node;

    /**
     * Machine identifier
     * @var string|int
     */
    private string|int $identifier;

    /**
     * ProxmoxVirtualMachineGetRequestModel constructor.
     * @param Request $request
     * @param string $node
     * @param string|int $identifier
     */
    public function __construct(Request $request, string $node, string|int $identifier)
    {
        $this->request = $request;
        $this->node = $node;
        $this->identifier = $identifier;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Get machine node
     * @return string
     */
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     * Get machine identifier
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}
