<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart\ProxmoxVirtualMachineRestartInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart\ProxmoxVirtualMachineRestartRequestModel;

/**
 * Class ProxmoxVirtualMachineRestartController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineRestartController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineRestartInputPort
     */
    private ProxmoxVirtualMachineRestartInputPort $interactor;

    /**
     * ProxmoxVirtualMachineRestartController constructor.
     * @param ProxmoxVirtualMachineRestartInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineRestartInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreRestart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $node
     * @param string|int $identifier
     * @return Response|null
     */
    public function __invoke(Request $request, string $node, string|int $identifier): ?Response
    {
        $viewModel = $this->interactor->restart(
            new ProxmoxVirtualMachineRestartRequestModel($request, $node, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
