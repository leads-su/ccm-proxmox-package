<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart;

use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineInterface;

/**
 * Class ProxmoxVirtualMachineRestartResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\Restart
 */
class ProxmoxVirtualMachineRestartResponseModel
{
    /**
     * Entity instance
     * @var VirtualMachineInterface|array
     */
    private VirtualMachineInterface|array $entity;

    /**
     * ProxmoxVirtualMachineRestartResponseModel constructor.
     * @param VirtualMachineInterface|array $entity
     * @return void
     */
    public function __construct(VirtualMachineInterface|array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Restart entity information
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
