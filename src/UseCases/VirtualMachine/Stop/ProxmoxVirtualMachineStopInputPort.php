<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineStopInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop
 */
interface ProxmoxVirtualMachineStopInputPort
{
    /**
     * Input port for "stop"
     * @param ProxmoxVirtualMachineStopRequestModel $requestModel
     * @return ViewModel
     */
    public function stop(ProxmoxVirtualMachineStopRequestModel $requestModel): ViewModel;
}
