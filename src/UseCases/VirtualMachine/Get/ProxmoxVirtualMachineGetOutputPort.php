<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineGetOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get
 */
interface ProxmoxVirtualMachineGetOutputPort
{
    /**
     * Output port for "get"
     * @param ProxmoxVirtualMachineGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(ProxmoxVirtualMachineGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param ProxmoxVirtualMachineGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(ProxmoxVirtualMachineGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineGetResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineGetResponseModel $responseModel, Throwable $throwable): ViewModel;
}
