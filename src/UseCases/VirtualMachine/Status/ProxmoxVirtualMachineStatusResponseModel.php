<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status;

/**
 * Class ProxmoxVirtualMachineStatusResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Status
 */
class ProxmoxVirtualMachineStatusResponseModel
{
    /**
     * Entity instance
     * @var array
     */
    private array $entity;

    /**
     * ProxmoxVirtualMachineStatusResponseModel constructor.
     * @param array $entity
     * @return void
     */
    public function __construct(array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Status entity information
     * @return array
     */
    public function getEntity(): array
    {
        return $this->entity;
    }
}
