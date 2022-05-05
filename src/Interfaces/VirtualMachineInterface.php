<?php

namespace ConsulConfigManager\Proxmox\Interfaces;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface VirtualMachineInterface
 * @package ConsulConfigManager\Proxmox\Interfaces
 */
interface VirtualMachineInterface extends Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    /**
     * Get virtual machine local id
     * @return int
     */
    public function getID(): int;

    /**
     * Set virtual machine local id
     * @param int $id
     * @return $this
     */
    public function setID(int $id): self;

    /**
     * Get virtual machine remote id
     * @return int
     */
    public function getIdentifier(): int;

    /**
     * Set virtual machine remote id
     * @param int $identifier
     * @return $this
     */
    public function setIdentifier(int $identifier): self;

    /**
     * Get virtual machine generation id
     * @return string
     */
    public function getGenerationID(): string;

    /**
     * Set virtual machine generation id
     * @param string $id
     * @return $this
     */
    public function setGenerationID(string $id): self;

    /**
     * Get virtual machine node
     * @return string
     */
    public function getNode(): string;

    /**
     * Set virtual machine node
     * @param string $node
     * @return $this
     */
    public function setNode(string $node): self;

    /**
     * Get virtual machine name
     * @return string
     */
    public function getName(): string;

    /**
     * Set virtual machine name
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self;

    /**
     * Get virtual machine description
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set virtual machine description
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self;

    /**
     * Get virtual machine numa node
     * @return int
     */
    public function getNuma(): int;

    /**
     * Set virtual machine numa node
     * @param int $numa
     * @return $this
     */
    public function setNuma(int $numa): self;

    /**
     * Get virtual machine sockets count
     * @return int
     */
    public function getSockets(): int;

    /**
     * Set virtual machine sockets count
     * @param int $sockets
     * @return $this
     */
    public function setSockets(int $sockets): self;

    /**
     * Get virtual machine core count
     * @return int
     */
    public function getCores(): int;

    /**
     * Set virtual machine core count
     * @param int $cores
     * @return $this
     */
    public function setCores(int $cores): self;

    /**
     * Get virtual machine memory amount
     * @return int
     */
    public function getMemory(): int;

    /**
     * Set virtual machine memory amount
     * @param int $memory
     * @return $this
     */
    public function setMemory(int $memory): self;
}
