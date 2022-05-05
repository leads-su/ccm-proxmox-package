<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start;

use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineInterface;

/**
 * Class ProxmoxVirtualMachineStartResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Start
 */
class ProxmoxVirtualMachineStartResponseModel
{
    /**
     * Entity instance
     * @var VirtualMachineInterface|array
     */
    private VirtualMachineInterface|array $entity;

    /**
     * ProxmoxVirtualMachineStartResponseModel constructor.
     * @param VirtualMachineInterface|array $entity
     * @return void
     */
    public function __construct(VirtualMachineInterface|array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Start entity information
     * @return array
     */
    public function getEntity(): array
    {
        if (is_array($this->entity)) {
            return $this->entity;
        }
        return $this->entity->toArray();
    }
}
