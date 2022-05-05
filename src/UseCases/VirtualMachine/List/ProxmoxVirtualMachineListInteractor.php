<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineListInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List
 */
class ProxmoxVirtualMachineListInteractor implements ProxmoxVirtualMachineListInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineListOutputPort
     */
    private ProxmoxVirtualMachineListOutputPort $output;

    /**
     * Repository instance
     * @var VirtualMachineRepositoryInterface
     */
    private VirtualMachineRepositoryInterface $repository;

    /**
     * ProxmoxVirtualMachineListInteractor constructor.
     * @param ProxmoxVirtualMachineListOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(ProxmoxVirtualMachineListOutputPort $output, VirtualMachineRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(ProxmoxVirtualMachineListRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->list(new ProxmoxVirtualMachineListResponseModel(
                $this->repository->all([
                    'id', 'vm_id', 'generation_id',
                    'node', 'name',
                    'cores', 'memory',
                ])
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new ProxmoxVirtualMachineListResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
