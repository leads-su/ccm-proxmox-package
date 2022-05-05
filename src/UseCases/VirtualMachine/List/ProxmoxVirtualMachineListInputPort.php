<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineListInputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List
 */
interface ProxmoxVirtualMachineListInputPort
{
    /**
     * Input port for "list"
     * @param ProxmoxVirtualMachineListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(ProxmoxVirtualMachineListRequestModel $requestModel): ViewModel;
}
