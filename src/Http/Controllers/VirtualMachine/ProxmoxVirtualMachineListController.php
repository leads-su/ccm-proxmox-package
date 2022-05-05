<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List\ProxmoxVirtualMachineListInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List\ProxmoxVirtualMachineListRequestModel;

/**
 * Class ProxmoxVirtualMachineListController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineListController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineListInputPort
     */
    private ProxmoxVirtualMachineListInputPort $interactor;

    /**
     * ProxmoxVirtualMachineListController constructor.
     * @param ProxmoxVirtualMachineListInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineListInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @return Response|null
     */
    public function __invoke(Request $request): ?Response
    {
        $viewModel = $this->interactor->list(
            new ProxmoxVirtualMachineListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
