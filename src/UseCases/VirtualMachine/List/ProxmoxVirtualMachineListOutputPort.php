<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineListOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List
 */
interface ProxmoxVirtualMachineListOutputPort
{
    /**
     * Output port for "list"
     * @param ProxmoxVirtualMachineListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(ProxmoxVirtualMachineListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineListResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineListResponseModel $responseModel, Throwable $throwable): ViewModel;
}
