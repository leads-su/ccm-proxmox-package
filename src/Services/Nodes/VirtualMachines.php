<?php

namespace ConsulConfigManager\Proxmox\Services\Nodes;

use Illuminate\Support\Arr;
use ConsulConfigManager\Proxmox\Services\AbstractService;

/**
 * Class VirtualMachines
 * @package ConsulConfigManager\Proxmox\Services\Nodes
 */
class VirtualMachines extends AbstractService
{
    /**
     * Get the virtual machine configuration with pending configuration changes applied.
     * Set the 'current' parameter to get the current configuration instead.
     * @param string $node
     * @param int $id
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/config
     */
    public function configuration(string $node, int $id): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/qemu/%d/config',
            $node,
            $id,
        ));
    }

    /**
     * Check if feature for virtual machine is available.
     * @param string $node
     * @param int $id
     * @param string $feature
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/feature
     */
    public function feature(string $node, int $id, string $feature): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/qemu/%d/feature',
            $node,
            $id,
        ), [
            'feature'       =>  $feature,
        ]);
    }

    /**
     * Get the virtual machine configuration with both current and pending values.
     * @param string $node
     * @param int $id
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/pending
     */
    public function pending(string $node, int $id): array
    {
        $response = $this->sendGetRequest(sprintf(
            'nodes/%s/qemu/%d/pending',
            $node,
            $id,
        ));
        $data = [];

        foreach ($response as $array) {
            $data[Arr::get($array, 'key')] = Arr::except($array, ['key']);
        }

        return $data;
    }

    /**
     * Get virtual machine status.
     * @param string $node
     * @param int $id
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/current
     */
    public function status(string $node, int $id): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/qemu/%d/status/current',
            $node,
            $id,
        ));
    }

    /**
     * Reboot virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/reboot
     */
    public function reboot(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/reboot',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }

    /**
     * Reset virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/reset
     */
    public function reset(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/reset',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }

    /**
     * Resume virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/resume
     */
    public function resume(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/resume',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }

    /**
     * Shutdown virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/shutdown
     */
    public function shutdown(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/shutdown',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }

    /**
     * Start virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/start
     */
    public function start(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/start',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }

    /**
     * Stop virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/stop
     */
    public function stop(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/stop',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }

    /**
     * Suspend virtual machine
     * @param string $node
     * @param int $id
     * @return string
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu/{vmid}/status/suspend
     */
    public function suspend(string $node, int $id): string
    {
        return $this->sendPostRequest(sprintf(
            'nodes/%s/qemu/%d/status/suspend',
            $node,
            $id,
        ), [
            'node'          =>  $node,
            'vmid'          =>  $id,
        ]);
    }
}
