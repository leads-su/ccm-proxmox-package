<?php

namespace ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class ProxmoxVirtualMachineListResponseModel
 * @package ConsulConfigManager\Proxmox\UseCases\VirtualMachine\List
 */
class ProxmoxVirtualMachineListResponseModel
{
    /**
     * Entities list
     * @var Collection|EloquentCollection|array
     */
    private Collection|EloquentCollection|array $entities;

    /**
     * ProxmoxVirtualMachineListResponseModel constructor.
     * @param Collection|EloquentCollection|array $entities
     * @return void
     */
    public function __construct(Collection|EloquentCollection|array $entities = [])
    {
        $this->entities = $entities;
    }

    /**
     * Get list of entities
     * @return array
     */
    public function getEntities(): array
    {
        if (is_array($this->entities)) {
            return $this->entities;
        }
        return $this->entities->toArray();
    }
}
