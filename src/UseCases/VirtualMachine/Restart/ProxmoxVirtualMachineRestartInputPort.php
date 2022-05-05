<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineRestartInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart
 */
interface ProxmoxVirtualMachineRestartInputPort
{
    /**
     * Input port for "restart"
     * @param ProxmoxVirtualMachineRestartRequestModel $requestModel
     * @return ViewModel
     */
    public function restart(ProxmoxVirtualMachineRestartRequestModel $requestModel): ViewModel;
}
