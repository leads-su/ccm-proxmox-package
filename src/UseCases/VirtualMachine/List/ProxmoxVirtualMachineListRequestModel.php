<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List;

use Illuminate\Http\Request;

/**
 * Class ProxmoxVirtualMachineListRequestModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List
 */
class ProxmoxVirtualMachineListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * ProxmoxVirtualMachineListRequestModel constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
