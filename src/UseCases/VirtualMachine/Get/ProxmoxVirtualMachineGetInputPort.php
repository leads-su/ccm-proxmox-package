<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineGetInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get
 */
interface ProxmoxVirtualMachineGetInputPort
{
    /**
     * Input port for "get"
     * @param ProxmoxVirtualMachineGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(ProxmoxVirtualMachineGetRequestModel $requestModel): ViewModel;
}
