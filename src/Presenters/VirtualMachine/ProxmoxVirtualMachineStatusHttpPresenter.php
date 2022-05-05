<?php

namespace ConsulConfigManager\Proxmox\Presenters\VirtualMachine;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status\ProxmoxVirtualMachineStatusOutputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status\ProxmoxVirtualMachineStatusResponseModel;

/**
 * Class ProxmoxVirtualMachineStatusHttpPresenter
 * @package ConsulConfigManager\Proxmox\Presenters\VirtualMachine
 */
class ProxmoxVirtualMachineStatusHttpPresenter implements ProxmoxVirtualMachineStatusOutputPort
{
    /**
     * @inheritDoc
     */
    public function status(ProxmoxVirtualMachineStatusResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully fetched status information for virtual machine',
            Response::HTTP_OK
        ));
    }

    public function notFound(ProxmoxVirtualMachineStatusResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'Unable to find virtual machine by provided parameters',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(ProxmoxVirtualMachineStatusResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to get virtual machine status',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
