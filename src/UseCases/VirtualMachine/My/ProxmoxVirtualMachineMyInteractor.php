<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class ProxmoxVirtualMachineMyInteractor
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My
 */
class ProxmoxVirtualMachineMyInteractor implements ProxmoxVirtualMachineMyInputPort
{
    /**
     * Output port instance
     * @var ProxmoxVirtualMachineMyOutputPort
     */
    private ProxmoxVirtualMachineMyOutputPort $output;

    /**
     * Repository instance
     * @var VirtualMachineRepositoryInterface
     */
    private VirtualMachineRepositoryInterface $repository;

    /**
     * ProxmoxVirtualMachineMyInteractor constructor.
     * @param ProxmoxVirtualMachineMyOutputPort $output
     * @param VirtualMachineRepositoryInterface $repository
     */
    public function __construct(
        ProxmoxVirtualMachineMyOutputPort $output,
        VirtualMachineRepositoryInterface $repository
    ) {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function my(ProxmoxVirtualMachineMyRequestModel $requestModel): ViewModel
    {
        try {
            $user = $requestModel->getUser();
            if (!$user) {
                throw new ModelNotFoundException();
            }

            return $this->output->my(new ProxmoxVirtualMachineMyResponseModel(
                $this->repository->findByEmailOrFail((string) $user->getEmail())->toArray()
            ));
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new ProxmoxVirtualMachineMyResponseModel());
            }

            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new ProxmoxVirtualMachineMyResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}
