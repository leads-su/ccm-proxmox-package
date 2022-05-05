<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start;

use Illuminate\Http\Request;

/**
 * Class ProxmoxVirtualMachineStartRequestModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start
 */
class ProxmoxVirtualMachineStartRequestModel
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
     * ProxmoxVirtualMachineStartRequestModel constructor.
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
     * Start request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Start machine node
     * @return string
     */
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     * Start machine identifier
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}
