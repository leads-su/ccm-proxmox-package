<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop\ProxmoxVirtualMachineStopInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop\ProxmoxVirtualMachineStopRequestModel;

/**
 * Class ProxmoxVirtualMachineStopController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineStopController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineStopInputPort
     */
    private ProxmoxVirtualMachineStopInputPort $interactor;

    /**
     * ProxmoxVirtualMachineStopController constructor.
     * @param ProxmoxVirtualMachineStopInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineStopInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStop

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $node
     * @param string|int $identifier
     * @return Response|null
     */
    public function __invoke(Request $request, string $node, string|int $identifier): ?Response
    {
        $viewModel = $this->interactor->stop(
            new ProxmoxVirtualMachineStopRequestModel($request, $node, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
