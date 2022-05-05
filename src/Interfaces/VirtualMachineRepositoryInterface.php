<?php

namespace ConsulConfigManager\Proxmox\Interfaces;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Interface VirtualMachineRepositoryInterface
 * @package ConsulConfigManager\Proxmox\Interfaces
 */
interface VirtualMachineRepositoryInterface
{
    /**
     * Get list of all entities from database
     * @param array $columns
     * @return EloquentCollection
     */
    public function all(array $columns = ['*']): EloquentCollection;

    /**
     * Check whether entity with given ID exists
     * @param string $node
     * @param int $id
     * @return bool
     */
    public function exists(string $node, int $id): bool;

    /**
     * Check whether entity with given ID exists or throw an exception
     * @param string $node
     * @param int $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function existsOrFail(string $node, int $id): void;

    /**
     * Find entity by given ID and Node name or return null
     * @param string $node
     * @param int $id
     * @param array $columns
     * @return VirtualMachineInterface|null
     */
    public function find(string $node, int $id, array $columns = ['*']): ?VirtualMachineInterface;

    /**
     * Find entity by given ID and Node name or fail
     * @param string $node
     * @param int $id
     * @param array $columns
     * @return VirtualMachineInterface
     * @throws ModelNotFoundException
     */
    public function findOrFail(string $node, int $id, array $columns = ['*']): VirtualMachineInterface;

    /**
     * Find entity by Username or return null
     * @param string $username
     * @param array $columns
     * @return VirtualMachineInterface|null
     */
    public function findByUsername(string $username, array $columns = ['*']): ?VirtualMachineInterface;

    /**
     * Find entity by Username or fail
     * @param string $username
     * @param array $columns
     * @return VirtualMachineInterface
     * @throws ModelNotFoundException
     */
    public function findByUsernameOrFail(string $username, array $columns = ['*']): VirtualMachineInterface;

    /**
     * Find entity by E-Mail or return null
     * @param string $email
     * @param array $columns
     * @return VirtualMachineInterface|null
     */
    public function findByEmail(string $email, array $columns = ['*']): ?VirtualMachineInterface;

    /**
     * Find entity by E-Mail or fail
     * @param string $email
     * @param array $columns
     * @return VirtualMachineInterface
     * @throws ModelNotFoundException
     */
    public function findByEmailOrFail(string $email, array $columns = ['*']): VirtualMachineInterface;

    /**
     * Find entity by specified column and value or return null
     * @param string $column
     * @param mixed $value
     * @param array $columns
     * @return VirtualMachineInterface|null
     */
    public function findBy(string $column, mixed $value, array $columns = ['*']): ?VirtualMachineInterface;

    /**
     * Find entity by specified column and value or fail
     * @param string $column
     * @param mixed $value
     * @param array $columns
     * @return VirtualMachineInterface
     * @throws ModelNotFoundException
     */
    public function findByOrFail(string $column, mixed $value, array $columns = ['*']): VirtualMachineInterface;

    /**
     * Create new entity
     * @param string $node
     * @param int $machine
     * @param array $configuration
     * @return VirtualMachineInterface
     */
    public function create(string $node, int $machine, array $configuration): VirtualMachineInterface;

    /**
     * Update existing entity
     * @param string $node
     * @param int $machine
     * @param array $configuration
     * @return VirtualMachineInterface
     * @throws ModelNotFoundException
     */
    public function update(string $node, int $machine, array $configuration): VirtualMachineInterface;

    /**
     * Delete existing entity
     * @param string $node
     * @param int $machine
     * @param bool $force
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(string $node, int $machine, bool $force = false): bool;

    /**
     * Force delete existing entity
     * @param string $node
     * @param int $machine
     * @return bool
     * @throws ModelNotFoundException
     */
    public function forceDelete(string $node, int $machine): bool;
}
