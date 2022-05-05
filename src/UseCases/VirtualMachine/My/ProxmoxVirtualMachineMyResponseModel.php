<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My;

/**
 * Class ProxmoxVirtualMachineMyResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\My
 */
class ProxmoxVirtualMachineMyResponseModel
{
    /**
     * Entity instance
     * @var array
     */
    private array $entity;

    /**
     * ProxmoxVirtualMachineMyResponseModel constructor.
     * @param array $entity
     * @return void
     */
    public function __construct(array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Get entity instance
     * @return array
     */
    public function getEntity(): array
    {
        return $this->entity;
    }
}
