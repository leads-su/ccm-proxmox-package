<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineStartOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start
 */
interface ProxmoxVirtualMachineStartOutputPort
{
    /**
     * Output port for "start"
     * @param ProxmoxVirtualMachineStartResponseModel $responseModel
     * @return ViewModel
     */
    public function start(ProxmoxVirtualMachineStartResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param ProxmoxVirtualMachineStartResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(ProxmoxVirtualMachineStartResponseModel $responseModel): ViewModel;

    /**
     * Output port for "forbidden"
     * @param ProxmoxVirtualMachineStartResponseModel $responseModel
     * @return ViewModel
     */
    public function forbidden(ProxmoxVirtualMachineStartResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineStartResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineStartResponseModel $responseModel, Throwable $throwable): ViewModel;
}
