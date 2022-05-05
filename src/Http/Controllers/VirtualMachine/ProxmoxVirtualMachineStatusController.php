<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status\ProxmoxVirtualMachineStatusInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status\ProxmoxVirtualMachineStatusRequestModel;

/**
 * Class ProxmoxVirtualMachineStatusController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineStatusController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineStatusInputPort
     */
    private ProxmoxVirtualMachineStatusInputPort $interactor;

    /**
     * ProxmoxVirtualMachineStatusController constructor.
     * @param ProxmoxVirtualMachineStatusInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineStatusInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $node
     * @param string|int $identifier
     * @return Response|null
     */
    public function __invoke(Request $request, string $node, string|int $identifier): ?Response
    {
        $viewModel = $this->interactor->status(
            new ProxmoxVirtualMachineStatusRequestModel($request, $node, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
