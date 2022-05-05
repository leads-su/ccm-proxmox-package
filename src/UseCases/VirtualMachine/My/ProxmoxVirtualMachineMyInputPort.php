<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineMyInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My
 */
interface ProxmoxVirtualMachineMyInputPort
{
    /**
     * Input port for "my"
     * @param ProxmoxVirtualMachineMyRequestModel $requestModel
     * @return ViewModel
     */
    public function my(ProxmoxVirtualMachineMyRequestModel $requestModel): ViewModel;
}
