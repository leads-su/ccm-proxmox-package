<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineStatusInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status
 */
interface ProxmoxVirtualMachineStatusInputPort
{
    /**
     * Input port for "status"
     * @param ProxmoxVirtualMachineStatusRequestModel $requestModel
     * @return ViewModel
     */
    public function status(ProxmoxVirtualMachineStatusRequestModel $requestModel): ViewModel;
}
