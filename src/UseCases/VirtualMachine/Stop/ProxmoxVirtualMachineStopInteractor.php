<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Proxmox\Services\Nodes\VirtualMachines;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineStopInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop
 */
class ProxmoxVirtualMachineStopInteractor implements ProxmoxVirtualMachineStopInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineStopOutputPort
     */
    private ProxmoxVirtualMachineStopOutputPort $output;

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
     * ProxmoxVirtualMachineStopInteractor constructor.
     * @param ProxmoxVirtualMachineStopOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineStopOutputPort $output, VirtualMachineRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = new VirtualMachines();
    }

    /**
     * @inheritDoc
     */
    public function stop(ProxmoxVirtualMachineStopRequestModel $requestModel): ViewModel
    {
        try {
            $user = $requestModel->getRequest()->user();
            $identifier = intval($requestModel->getIdentifier());

            $this->repository->existsOrFail($requestModel->getNode(), $identifier);

            if (!$user) {
                return $this->output->forbidden(new ProxmoxVirtualMachineStopResponseModel());
            }

            if (!$user->hasRole('administrator')) {
                $model = $this->repository->findByUsername($user->getUsername());
                if ($model->getIdentifier() !== $identifier) {
                    return $this->output->forbidden(new ProxmoxVirtualMachineStopResponseModel());
                }
            }

            $this->service->stop($requestModel->getNode(), $identifier);
            return $this->output->stop(new ProxmoxVirtualMachineStopResponseModel());
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new ProxmoxVirtualMachineStopResponseModel());
            }

            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new ProxmoxVirtualMachineStopResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
