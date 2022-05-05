<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class ProxmoxVirtualMachineMyRequestModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My
 */
class ProxmoxVirtualMachineMyRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * ProxmoxVirtualMachineMyRequestModel constructor.
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

    /**
     * Get user who made the request
     * @return UserInterface|null
     */
    public function getUser(): UserInterface|null
    {
        return $this->getRequest()->user();
    }
}
