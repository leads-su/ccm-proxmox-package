<?php

namespace ConsulConfigManager\Proxmox\Services;

/**
 * Class Nodes
 * @package ConsulConfigManager\Proxmox\Services
 */
class Nodes extends AbstractService
{
    /**
     * Get list of nodes in the datacenter
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes
     */
    public function list(): array
    {
        return $this->sendGetRequest('nodes');
    }

    /**
     * Get list of containers on the specified node
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/lxc
     */
    public function containers(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/lxc',
            $node
        ));
    }

    /**
     * Get list of virtual machines on the specified node
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/qemu
     */
    public function virtualMachines(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/qemu',
            $node
        ));
    }

    /**
     * Get node configuration options.
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/config
     */
    public function configuration(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/config',
            $node
        ));
    }

    /**
     * Read DNS settings.
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/dns
     */
    public function dns(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/dns',
            $node
        ));
    }

    /**
     * Start all VMs and containers located on this node (by default only those with onboot=1).
     * @param string $node
     * @param array $machines
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/startall
     */
    public function startAll(string $node, array $machines = []): array
    {
        $parameters = [
            'node'      =>  $node,
        ];
        if (!empty($machines)) {
            $parameters['vms'] = implode(',', $machines);
        }

        return $this->sendPostRequest(sprintf(
            'nodes/%s/startall',
            $node
        ), $parameters);
    }

    /**
     * Read node status.
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/status
     */
    public function status(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/status',
            $node
        ));
    }

    /**
     * Stop all VMs and Containers.
     * @param string $node
     * @param array $machines
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/stopall
     */
    public function stopAll(string $node, array $machines = []): array
    {
        $parameters = [
            'node'      =>  $node,
        ];
        if (!empty($machines)) {
            $parameters['vms'] = implode(',', $machines);
        }

        return $this->sendPostRequest(sprintf(
            'nodes/%s/stopall',
            $node
        ), $parameters);
    }

    /**
     * Read subscription info.
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/subscription
     */
    public function subscription(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/subscription',
            $node
        ));
    }

    /**
     * Read server time and time zone settings.
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/time
     */
    public function time(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/time',
            $node
        ));
    }

    /**
     * API version details
     * @param string $node
     * @return array
     * @see https://pve.proxmox.com/pve-docs/api-viewer/index.html#/nodes/{node}/version
     */
    public function version(string $node): array
    {
        return $this->sendGetRequest(sprintf(
            'nodes/%s/version',
            $node
        ));
    }
}
