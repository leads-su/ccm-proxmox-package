<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineStopOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop
 */
interface ProxmoxVirtualMachineStopOutputPort
{
    /**
     * Output port for "stop"
     * @param ProxmoxVirtualMachineStopResponseModel $responseModel
     * @return ViewModel
     */
    public function stop(ProxmoxVirtualMachineStopResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param ProxmoxVirtualMachineStopResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(ProxmoxVirtualMachineStopResponseModel $responseModel): ViewModel;

    /**
     * Output port for "forbidden"
     * @param ProxmoxVirtualMachineStopResponseModel $responseModel
     * @return ViewModel
     */
    public function forbidden(ProxmoxVirtualMachineStopResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineStopResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineStopResponseModel $responseModel, Throwable $throwable): ViewModel;
}
