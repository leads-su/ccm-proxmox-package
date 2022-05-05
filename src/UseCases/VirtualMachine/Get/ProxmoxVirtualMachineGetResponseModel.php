<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get;

use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineInterface;

/**
 * Class ProxmoxVirtualMachineGetResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Get
 */
class ProxmoxVirtualMachineGetResponseModel
{
    /**
     * Entity instance
     * @var VirtualMachineInterface|array
     */
    private VirtualMachineInterface|array $entity;

    /**
     * ProxmoxVirtualMachineGetResponseModel constructor.
     * @param VirtualMachineInterface|array $entity
     * @return void
     */
    public function __construct(VirtualMachineInterface|array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Get entity information
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
