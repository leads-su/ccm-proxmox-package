<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart;

use Illuminate\Http\Request;

/**
 * Class ProxmoxVirtualMachineRestartRequestModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart
 */
class ProxmoxVirtualMachineRestartRequestModel
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
     * ProxmoxVirtualMachineRestartRequestModel constructor.
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
     * Restart request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Restart machine node
     * @return string
     */
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     * Restart machine identifier
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}
