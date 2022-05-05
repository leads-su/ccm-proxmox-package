<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Proxmox\Services\Nodes\VirtualMachines;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineRestartInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart
 */
class ProxmoxVirtualMachineRestartInteractor implements ProxmoxVirtualMachineRestartInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineRestartOutputPort
     */
    private ProxmoxVirtualMachineRestartOutputPort $output;

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
     * ProxmoxVirtualMachineRestartInteractor constructor.
     * @param ProxmoxVirtualMachineRestartOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineRestartOutputPort $output, VirtualMachineRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = new VirtualMachines();
    }

    /**
     * @inheritDoc
     */
    public function restart(ProxmoxVirtualMachineRestartRequestModel $requestModel): ViewModel
    {
        try {
            $user = $requestModel->getRequest()->user();
            $identifier = intval($requestModel->getIdentifier());

            $this->repository->existsOrFail($requestModel->getNode(), $identifier);

            if (!$user) {
                return $this->output->forbidden(new ProxmoxVirtualMachineRestartResponseModel());
            }

            if (!$user->hasRole('administrator')) {
                $model = $this->repository->findByUsername($user->getUsername());
                if ($model->getIdentifier() !== $identifier) {
                    return $this->output->forbidden(new ProxmoxVirtualMachineRestartResponseModel());
                }
            }

            $this->service->reboot($requestModel->getNode(), $identifier);
            return $this->output->restart(new ProxmoxVirtualMachineRestartResponseModel());
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new ProxmoxVirtualMachineRestartResponseModel());
            }

            // @codeCoverageIgnoreRestart
            return $this->output->internalServerError(new ProxmoxVirtualMachineRestartResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
