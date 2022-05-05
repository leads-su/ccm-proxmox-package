<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineStartInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start
 */
interface ProxmoxVirtualMachineStartInputPort
{
    /**
     * Input port for "start"
     * @param ProxmoxVirtualMachineStartRequestModel $requestModel
     * @return ViewModel
     */
    public function start(ProxmoxVirtualMachineStartRequestModel $requestModel): ViewModel;
}
