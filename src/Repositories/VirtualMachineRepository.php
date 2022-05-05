<?php

namespace ConsulConfigManager\Proxmox\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use ConsulConfigManager\Proxmox\Models\VirtualMachine;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineInterface;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

/**
 * Class VirtualMachineRepository
 * @package ConsulConfigManager\Proxmox\Repositories
 */
class VirtualMachineRepository implements VirtualMachineRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): EloquentCollection
    {
        return VirtualMachine::all($columns);
    }

    /**
     * @inheritDoc
     */
    public function exists(string $node, int $id): bool
    {
        return VirtualMachine::where('vm_id', '=', $id)->where('node', '=', $node)->exists();
    }

    /**
     * @inheritDoc
     */
    public function existsOrFail(string $node, int $id): void
    {
        if (!$this->exists($node, $id)) {
            throw new ModelNotFoundException();
        }
    }

    /**
     * @inheritDoc
     */
    public function find(string $node, int $id, array $columns = ['*']): ?VirtualMachineInterface
    {
        return VirtualMachine::where('vm_id', '=', $id)->where('node', '=', $node)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $node, int $id, array $columns = ['*']): VirtualMachineInterface
    {
        return VirtualMachine::where('vm_id', '=', $id)->where('node', '=', $node)->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByUsername(string $username, array $columns = ['*']): ?VirtualMachineInterface
    {
        return VirtualMachine::where('description', 'LIKE', '%' . $username . '%')->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByUsernameOrFail(string $username, array $columns = ['*']): VirtualMachineInterface
    {
        return VirtualMachine::where('description', 'LIKE', '%' . $username . '%')->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email, array $columns = ['*']): ?VirtualMachineInterface
    {
        return VirtualMachine::where('description', 'LIKE', '%' . $email . '%')->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByEmailOrFail(string $email, array $columns = ['*']): VirtualMachineInterface
    {
        return VirtualMachine::where('description', 'LIKE', '%' . $email . '%')->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $column, mixed $value, array $columns = ['*']): ?VirtualMachineInterface
    {
        return VirtualMachine::where($column, '=', $value)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByOrFail(string $column, mixed $value, array $columns = ['*']): VirtualMachineInterface
    {
        return VirtualMachine::where($column, '=', $value)->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function create(string $node, int $machine, array $configuration): VirtualMachineInterface
    {
        return VirtualMachine::create($this->configurationToModelAttributes(
            node: $node,
            machine: $machine,
            configuration: $configuration,
        ));
    }

    /**
     * @inheritDoc
     */
    public function update(string $node, int $machine, array $configuration): VirtualMachineInterface
    {
        $model = $this->findOrFail($node, $machine);

        $attributes = $this->configurationToModelAttributes(
            node: $node,
            machine: $machine,
            configuration: $configuration,
        );

        $attributes = Arr::except($attributes, ['vm_id']);

        $model->update($attributes);

        return $this->findOrFail($node, $machine);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $node, int $machine, bool $force = false): bool
    {
        $model = $this->findOrFail($node, $machine);
        if ($force) {
            return $model->forceDelete();
        }
        return $model->delete();
    }

    /**
     * @inheritDoc
     */
    public function forceDelete(string $node, int $machine): bool
    {
        return $this->delete($node, $machine, true);
    }

    /**
     * Convert configuration array to VirtualMachine model attributes
     * @param string $node
     * @param int $machine
     * @param array $configuration
     * @return array
     */
    private function configurationToModelAttributes(string $node, int $machine, array $configuration): array
    {
        $attributes = Arr::only($configuration, [
            'name', 'description',
            'numa', 'sockets', 'cores',
            'memory',
        ]);

        Arr::set($attributes, 'vm_id', $machine);
        Arr::set($attributes, 'node', $node);
        Arr::set($attributes, 'generation_id', Arr::get($configuration, 'vmgenid'));

        $diskPrefixes = ['ide', 'sata', 'scsi', 'virtio'];

        $diskIndex = 0;
        $netIndex = 0;

        foreach ($configuration as $key => $value) {
            $diskSizeKey = 'disk_' . $diskIndex . '_size';
            $diskTypeKey = 'disk_' . $diskIndex . '_type';
            $networkDeviceKey = 'network_' . $netIndex . '_device';
            $networkMacKey = 'network_' . $netIndex . '_mac';
            $networkTypeKey = 'network_' . $netIndex . '_type';
            $networkBridgeKey = 'network_' . $netIndex . '_bridge';

            if (Str::startsWith($key, $diskPrefixes)) {
                if (false !== stripos($value, 'size=')) {
                    Arr::set($attributes, $diskSizeKey, Str::after($value, 'size='));
                    Arr::set($attributes, $diskTypeKey, preg_replace('/\d+/u', '', $key));
                    $diskIndex++;
                }
            } elseif (Str::startsWith($key, 'net')) {
                $parts = explode(',', $value);
                if (count($parts) >= 2) {
                    [$device, $mac] = explode('=', $parts[0]);
                    [$type, $bridge] = explode('=', $parts[1]);

                    Arr::set($attributes, $networkDeviceKey, $device);
                    Arr::set($attributes, $networkMacKey, $mac);
                    Arr::set($attributes, $networkTypeKey, $type);
                    Arr::set($attributes, $networkBridgeKey, $bridge);
                    $netIndex++;
                }
            }
        }
        return $attributes;
    }
}
