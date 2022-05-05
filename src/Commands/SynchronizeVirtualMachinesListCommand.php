<?php

namespace ConsulConfigManager\Proxmox\Commands;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use ConsulConfigManager\Proxmox\Services\Nodes;
use ConsulConfigManager\Proxmox\Interfaces\VirtualMachineRepositoryInterface;

// @codeCoverageIgnoreStart

/**
 * Class SynchronizeVirtualMachinesListCommand
 * @package ConsulConfigManager\Proxmox\Commands
 */
class SynchronizeVirtualMachinesListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proxmox:vm:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize list of virtual machines with Proxmox';

    /**
     * Repository instance
     * @var VirtualMachineRepositoryInterface
     */
    private VirtualMachineRepositoryInterface $repository;

    /**
     * Nodes service instance
     * @var Nodes
     */
    private Nodes $nodesService;

    /**
     * Virtual Machines service instance
     * @var Nodes\VirtualMachines
     */
    private Nodes\VirtualMachines $virtualMachinesService;

    /**
     * List of nodes we are allowed to access
     * @var array
     */
    private array $allowedNodes = [];

    /**
     * List of machines we are allowed to access
     * @var array
     */
    private array $allowedMachines = [];

    /**
     * SynchronizeVirtualMachinesListCommand constructor.
     * @param VirtualMachineRepositoryInterface $repository
     * @return void
     */
    public function __construct(VirtualMachineRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->nodesService = new Nodes();
        $this->virtualMachinesService = new Nodes\VirtualMachines();
        $this->allowedNodes = config('domain.proxmox.restrictions.nodes', []);
        $this->allowedMachines = config('domain.proxmox.restrictions.machines', []);
        parent::__construct();
    }

    /**
     * Execute console command.
     * @return int
     */
    public function handle(): int
    {
        $nodesList = $this->nodesService->list();

        foreach ($nodesList as $nodeData) {
            $node = Arr::get($nodeData, 'node');

            if ($this->isValidNode($node)) {
                foreach ($this->nodesService->virtualMachines($node) as $virtualMachineData) {
                    $machine = intval(Arr::get($virtualMachineData, 'vmid'));
                    if ($this->isValidMachine($machine)) {
                        $configuration = $this->virtualMachinesService->configuration($node, $machine);
                        $machineName = Arr::get($configuration, 'name');
                        if ($this->repository->exists($node, $machine)) {
                            $this->repository->update($node, $machine, $configuration);
                            $this->warn(sprintf(
                                '%s - updated database record',
                                $machineName,
                            ));
                        } else {
                            $this->repository->create($node, $machine, $configuration);
                            $this->info(sprintf(
                                '%s - created database record',
                                $machineName,
                            ));
                        }
                    } else {
                        $this->warn(sprintf('Skipping `%d` on node `%s` as it is not in the list of allowed machines.', $machine, $node));
                    }
                }
            } else {
                $this->warn(sprintf('Skipping `%s` as it is not in the list of allowed nodes.', $node));
            }
        }

        return Command::SUCCESS;
    }

    /**
     * Check whether provided node name is in a list of allowed nodes
     * @param string $node
     * @return bool
     */
    private function isValidNode(string $node): bool
    {
        if (count($this->allowedNodes) === 0) {
            return true;
        }
        return in_array($node, $this->allowedNodes);
    }

    /**
     * Check whether provided machine id is in a list of allowed machines
     * @param int $machine
     * @return bool
     */
    private function isValidMachine(int $machine): bool
    {
        if (count($this->allowedMachines) === 0) {
            return true;
        }
        return in_array($machine, $this->allowedMachines);
    }
}

// @codeCoverageIgnoreEnd
