<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop;

use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineInterface;

/**
 * Class ProxmoxVirtualMachineStopResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Stop
 */
class ProxmoxVirtualMachineStopResponseModel
{
    /**
     * Entity instance
     * @var VirtualMachineInterface|array
     */
    private VirtualMachineInterface|array $entity;

    /**
     * ProxmoxVirtualMachineStopResponseModel constructor.
     * @param VirtualMachineInterface|array $entity
     * @return void
     */
    public function __construct(VirtualMachineInterface|array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Stop entity information
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
