<?php

namespace ConsulConfigManager\Proxmox\Presenters\VirtualMachine;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart\ProxmoxVirtualMachineRestartOutputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart\ProxmoxVirtualMachineRestartResponseModel;

/**
 * Class ProxmoxVirtualMachineRestartHttpPresenter
 * @package ConsulConfigManager\Proxmox\Presenters\VirtualMachine
 */
class ProxmoxVirtualMachineRestartHttpPresenter implements ProxmoxVirtualMachineRestartOutputPort
{
    /**
     * @inheritDoc
     */
    public function restart(ProxmoxVirtualMachineRestartResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully restarted virtual machine',
            Response::HTTP_OK
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(ProxmoxVirtualMachineRestartResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'Unable to find virtual machine by provided parameters',
            Response::HTTP_NOT_FOUND,
        ));
    }

    /**
     * @inheritDoc
     */
    public function forbidden(ProxmoxVirtualMachineRestartResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'You are not allowed to restart virtual machines which do not belong to you',
            Response::HTTP_FORBIDDEN,
        ));
    }

    // @codeCoverageIgnoreRestart
    /**
     * @inheritDoc
     */
    public function internalServerError(ProxmoxVirtualMachineRestartResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to restart virtual machine',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
