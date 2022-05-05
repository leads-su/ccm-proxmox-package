<?php

namespace ConsulConfigManager\Proxmox\Presenters\VirtualMachine;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My\ProxmoxVirtualMachineMyOutputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My\ProxmoxVirtualMachineMyResponseModel;

/**
 * Class ProxmoxVirtualMachineMyHttpPresenter
 * @package ConsulConfigManager\Proxmox\Presenters\VirtualMachine
 */
class ProxmoxVirtualMachineMyHttpPresenter implements ProxmoxVirtualMachineMyOutputPort
{
    /**
     * @inheritDoc
     */
    public function my(ProxmoxVirtualMachineMyResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully fetched information for user virtual machine',
            Response::HTTP_OK
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(ProxmoxVirtualMachineMyResponseModel $responseModel): ViewModel
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
    public function internalServerError(ProxmoxVirtualMachineMyResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to get virtual machine information',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
