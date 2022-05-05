<?php

namespace ConsulConfigManager\Proxmox\Models;

use Illuminate\Database\Eloquent\Model;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineInterface;

/**
 * Class VirtualMachine
 * @package ConsulConfigManager\Proxmox\Models
 */
class VirtualMachine extends Model implements VirtualMachineInterface
{
    /**
     * @inheritDoc
     */
    public $table = 'proxmox_virtual_machines';

    /**
     * @inheritDoc
     */
    public $fillable = [
        'vm_id',
        'node',
        'generation_id',
        'name',
        'description',
        'numa',
        'sockets',
        'cores',
        'memory',
        'disk_0_size',
        'disk_0_type',
        'disk_1_size',
        'disk_1_type',
        'disk_2_size',
        'disk_2_type',
        'disk_3_size',
        'disk_3_type',
        'network_0_device',
        'network_0_mac',
        'network_0_type',
        'network_0_bridge',
        'network_1_device',
        'network_1_mac',
        'network_1_type',
        'network_1_bridge',
        'network_2_device',
        'network_2_mac',
        'network_2_type',
        'network_2_bridge',
    ];

    /**
     * @inheritDoc
     */
    public $casts = [
        'id'                    =>  'integer',
        'vm_id'                 =>  'integer',
        'node'                  =>  'string',
        'generation_id'         =>  'string',
        'name'                  =>  'string',
        'description'           =>  'string',
        'numa'                  =>  'integer',
        'sockets'               =>  'integer',
        'cores'                 =>  'integer',
        'memory'                =>  'integer',
        'disk_0_size'           =>  'string',
        'disk_0_type'           =>  'string',
        'disk_1_size'           =>  'string',
        'disk_1_type'           =>  'string',
        'disk_2_size'           =>  'string',
        'disk_2_type'           =>  'string',
        'disk_3_size'           =>  'string',
        'disk_3_type'           =>  'string',
        'network_0_device'      =>  'string',
        'network_0_mac'         =>  'string',
        'network_0_type'        =>  'string',
        'network_0_bridge'      =>  'string',
        'network_1_device'      =>  'string',
        'network_1_mac'         =>  'string',
        'network_1_type'        =>  'string',
        'network_1_bridge'      =>  'string',
        'network_2_device'      =>  'string',
        'network_2_mac'         =>  'string',
        'network_2_type'        =>  'string',
        'network_2_bridge'      =>  'string',
    ];

    /**
     * @inheritDoc
     */
    public $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritDoc
     */
    public function getID(): int
    {
        return (int) $this->attributes['id'];
    }

    /**
     * @inheritDoc
     */
    public function setID(int $id): VirtualMachineInterface
    {
        $this->attributes['id'] = (int) $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier(): int
    {
        return (int) $this->attributes['vm_id'];
    }

    /**
     * @inheritDoc
     */
    public function setIdentifier(int $identifier): VirtualMachineInterface
    {
        $this->attributes['vm_id'] = (int) $identifier;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getGenerationID(): string
    {
        return (string) $this->attributes['generation_id'];
    }

    /**
     * @inheritDoc
     */
    public function setGenerationID(string $id): VirtualMachineInterface
    {
        $this->attributes['generation_id'] = (string) $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getNode(): string
    {
        return (string) $this->attributes['node'];
    }

    /**
     * @inheritDoc
     */
    public function setNode(string $node): VirtualMachineInterface
    {
        $this->attributes['node'] = (string) $node;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return (string) $this->attributes['name'];
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): VirtualMachineInterface
    {
        $this->attributes['name'] = (string) $name;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return (string) $this->attributes['description'];
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): VirtualMachineInterface
    {
        $this->attributes['description'] = (string) $description;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getNuma(): int
    {
        return (int) $this->attributes['numa'];
    }

    /**
     * @inheritDoc
     */
    public function setNuma(int $numa): VirtualMachineInterface
    {
        $this->attributes['numa'] = (int) $numa;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSockets(): int
    {
        return (int) $this->attributes['sockets'];
    }

    /**
     * @inheritDoc
     */
    public function setSockets(int $sockets): VirtualMachineInterface
    {
        $this->attributes['sockets'] = (int) $sockets;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCores(): int
    {
        return (int) $this->attributes['cores'];
    }

    /**
     * @inheritDoc
     */
    public function setCores(int $cores): VirtualMachineInterface
    {
        $this->attributes['cores'] = (int) $cores;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMemory(): int
    {
        return (int) $this->attributes['memory'];
    }

    /**
     * @inheritDoc
     */
    public function setMemory(int $memory): VirtualMachineInterface
    {
        $this->attributes['memory'] = (int) $memory;
        return $this;
    }
}
