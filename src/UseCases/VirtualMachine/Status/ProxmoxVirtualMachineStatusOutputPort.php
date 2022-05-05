<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineStatusOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status
 */
interface ProxmoxVirtualMachineStatusOutputPort
{
    /**
     * Output port for "status"
     * @param ProxmoxVirtualMachineStatusResponseModel $responseModel
     * @return ViewModel
     */
    public function status(ProxmoxVirtualMachineStatusResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param ProxmoxVirtualMachineStatusResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(ProxmoxVirtualMachineStatusResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineStatusResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineStatusResponseModel $responseModel, Throwable $throwable): ViewModel;
}
