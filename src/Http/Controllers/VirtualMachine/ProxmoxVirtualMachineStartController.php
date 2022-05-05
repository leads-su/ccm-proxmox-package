<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start\ProxmoxVirtualMachineStartInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start\ProxmoxVirtualMachineStartRequestModel;

/**
 * Class ProxmoxVirtualMachineStartController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineStartController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineStartInputPort
     */
    private ProxmoxVirtualMachineStartInputPort $interactor;

    /**
     * ProxmoxVirtualMachineStartController constructor.
     * @param ProxmoxVirtualMachineStartInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineStartInputPort $interactor)
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
        $viewModel = $this->interactor->start(
            new ProxmoxVirtualMachineStartRequestModel($request, $node, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
