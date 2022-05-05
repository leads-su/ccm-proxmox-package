<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status;

use Illuminate\Http\Request;

/**
 * Class ProxmoxVirtualMachineStatusRequestModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status
 */
class ProxmoxVirtualMachineStatusRequestModel
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
     * ProxmoxVirtualMachineStatusRequestModel constructor.
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
     * Status request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Status machine node
     * @return string
     */
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     * Status machine identifier
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}
