<?php

namespace ConsulConfigManager\Proxmox\Presenters\VirtualMachine;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List\ProxmoxVirtualMachineListOutputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List\ProxmoxVirtualMachineListResponseModel;

/**
 * Class ProxmoxVirtualMachineListHttpPresenter
 * @package ConsulConfigManager\Proxmox\Presenters\VirtualMachine
 */
class ProxmoxVirtualMachineListHttpPresenter implements ProxmoxVirtualMachineListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(ProxmoxVirtualMachineListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of virtual machines',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(ProxmoxVirtualMachineListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }
        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to get list of virtual machines',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
