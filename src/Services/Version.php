<?php

namespace ConsulConfigManager\Proxmox\Services;

/**
 * Class Version
 * @package ConsulConfigManager\Proxmox\Services
 */
class Version extends AbstractService
{
    /**
     * Get installed Proxmox VE version
     * @return array
     */
    public function get(): array
    {
        return $this->sendGetRequest('version');
    }
}
