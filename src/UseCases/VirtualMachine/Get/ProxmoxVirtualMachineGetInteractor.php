<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineGetInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get
 */
class ProxmoxVirtualMachineGetInteractor implements ProxmoxVirtualMachineGetInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineGetOutputPort
     */
    private ProxmoxVirtualMachineGetOutputPort $output;

    /**
     * Repository instance
     * @var VirtualMachineRepositoryInterface
     */
    private VirtualMachineRepositoryInterface $repository;

    /**
     * ProxmoxVirtualMachineGetInteractor constructor.
     * @param ProxmoxVirtualMachineGetOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineGetOutputPort $output, VirtualMachineRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(ProxmoxVirtualMachineGetRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->get(new ProxmoxVirtualMachineGetResponseModel(
                $this->repository->findOrFail(
                    node: $requestModel->getNode(),
                    id: intval($requestModel->getIdentifier())
                )
            ));
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new ProxmoxVirtualMachineGetResponseModel());
            }

            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new ProxmoxVirtualMachineGetResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
