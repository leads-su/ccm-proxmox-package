<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface ProxmoxVirtualMachineRestartOutputPort
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart
 */
interface ProxmoxVirtualMachineRestartOutputPort
{
    /**
     * Output port for "restart"
     * @param ProxmoxVirtualMachineRestartResponseModel $responseModel
     * @return ViewModel
     */
    public function restart(ProxmoxVirtualMachineRestartResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param ProxmoxVirtualMachineRestartResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(ProxmoxVirtualMachineRestartResponseModel $responseModel): ViewModel;

    /**
     * Output port for "forbidden"
     * @param ProxmoxVirtualMachineRestartResponseModel $responseModel
     * @return ViewModel
     */
    public function forbidden(ProxmoxVirtualMachineRestartResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param ProxmoxVirtualMachineRestartResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(ProxmoxVirtualMachineRestartResponseModel $responseModel, Throwable $throwable): ViewModel;
}
