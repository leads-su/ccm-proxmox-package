<?php

namespace ConsulConfigManager\Proxmox\Presenters\VirtualMachine;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start\ProxmoxVirtualMachineStartOutputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start\ProxmoxVirtualMachineStartResponseModel;

/**
 * Class ProxmoxVirtualMachineStartHttpPresenter
 * @package ConsulConfigManager\Proxmox\Presenters\VirtualMachine
 */
class ProxmoxVirtualMachineStartHttpPresenter implements ProxmoxVirtualMachineStartOutputPort
{
    /**
     * @inheritDoc
     */
    public function start(ProxmoxVirtualMachineStartResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully started virtual machine',
            Response::HTTP_OK
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(ProxmoxVirtualMachineStartResponseModel $responseModel): ViewModel
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
    public function forbidden(ProxmoxVirtualMachineStartResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'You are not allowed to start virtual machines which do not belong to you',
            Response::HTTP_FORBIDDEN,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(ProxmoxVirtualMachineStartResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to start virtual machine',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
