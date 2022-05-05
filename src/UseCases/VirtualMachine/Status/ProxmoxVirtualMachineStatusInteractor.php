<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Proxmox\Services\Nodes\VirtualMachines;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineStatusInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status
 */
class ProxmoxVirtualMachineStatusInteractor implements ProxmoxVirtualMachineStatusInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineStatusOutputPort
     */
    private ProxmoxVirtualMachineStatusOutputPort $output;

    /**
     * Repository instance
     * @var VirtualMachineRepositoryInterface
     */
    private VirtualMachineRepositoryInterface $repository;

    /**
     * Service instance
     * @var VirtualMachines
     */
    private VirtualMachines $service;

    /**
     * ProxmoxVirtualMachineStatusInteractor constructor.
     * @param ProxmoxVirtualMachineStatusOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineStatusOutputPort $output, VirtualMachineRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = new VirtualMachines();
    }

    /**
     * @inheritDoc
     */
    public function status(ProxmoxVirtualMachineStatusRequestModel $requestModel): ViewModel
    {
        try {
            $machine = $this->repository->findOrFail(
                node: $requestModel->getNode(),
                id: intval($requestModel->getIdentifier())
            );

            return $this->output->status(new ProxmoxVirtualMachineStatusResponseModel(
                $this->service->status($machine->getNode(), $machine->getIdentifier())
            ));
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new ProxmoxVirtualMachineStatusResponseModel());
            }

            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new ProxmoxVirtualMachineStatusResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
