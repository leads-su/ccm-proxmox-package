<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineMyOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My
 */
interface ProxmoxVirtualMachineMyOutputPort
{
    /**
     * Output port for "my"
     * @param ProxmoxVirtualMachineMyResponseModel $responseModel
     * @return ViewModel
     */
    public function my(ProxmoxVirtualMachineMyResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param ProxmoxVirtualMachineMyResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(ProxmoxVirtualMachineMyResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineMyResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineMyResponseModel $responseModel, Throwable $throwable): ViewModel;
}
