<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My\ProxmoxVirtualMachineMyInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My\ProxmoxVirtualMachineMyRequestModel;

/**
 * Class ProxmoxVirtualMachineMyController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineMyController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineMyInputPort
     */
    private ProxmoxVirtualMachineMyInputPort $interactor;

    /**
     * ProxmoxVirtualMachineMyController constructor.
     * @param ProxmoxVirtualMachineMyInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineMyInputPort $interactor)
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
        $viewModel = $this->interactor->my(
            new ProxmoxVirtualMachineMyRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
