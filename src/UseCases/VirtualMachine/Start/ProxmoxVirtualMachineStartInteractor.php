<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Proxmox\Services\Nodes\VirtualMachines;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineStartInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start
 */
class ProxmoxVirtualMachineStartInteractor implements ProxmoxVirtualMachineStartInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineStartOutputPort
     */
    private ProxmoxVirtualMachineStartOutputPort $output;

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
     * ProxmoxVirtualMachineStartInteractor constructor.
     * @param ProxmoxVirtualMachineStartOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineStartOutputPort $output, VirtualMachineRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = new VirtualMachines();
    }

    /**
     * @inheritDoc
     */
    public function start(ProxmoxVirtualMachineStartRequestModel $requestModel): ViewModel
    {
        try {
            $user = $requestModel->getRequest()->user();
            $identifier = intval($requestModel->getIdentifier());

            $this->repository->existsOrFail($requestModel->getNode(), $identifier);

            if (!$user) {
                return $this->output->forbidden(new ProxmoxVirtualMachineStartResponseModel());
            }

            if (!$user->hasRole('administrator')) {
                $model = $this->repository->findByUsername($user->getUsername());
                if ($model->getIdentifier() !== $identifier) {
                    return $this->output->forbidden(new ProxmoxVirtualMachineStartResponseModel());
                }
            }

            $this->service->start($requestModel->getNode(), $identifier);
            return $this->output->start(new ProxmoxVirtualMachineStartResponseModel());
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new ProxmoxVirtualMachineStartResponseModel());
            }

            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new ProxmoxVirtualMachineStartResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
