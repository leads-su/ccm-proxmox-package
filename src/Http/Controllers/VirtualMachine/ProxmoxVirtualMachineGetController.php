<?php

namespace ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get\ProxmoxVirtualMachineGetInputPort;
use ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get\ProxmoxVirtualMachineGetRequestModel;

/**
 * Class ProxmoxVirtualMachineGetController
 * @package ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine
 */
class ProxmoxVirtualMachineGetController extends Controller
{
    /**
     * Interactor instance
     * @var ProxmoxVirtualMachineGetInputPort
     */
    private ProxmoxVirtualMachineGetInputPort $interactor;

    /**
     * ProxmoxVirtualMachineGetController constructor.
     * @param ProxmoxVirtualMachineGetInputPort $interactor
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineGetInputPort $interactor)
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
        $viewModel = $this->interactor->get(
            new ProxmoxVirtualMachineGetRequestModel($request, $node, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }
        return null;
    }

    // @codeCoverageIgnoreEnd
}
