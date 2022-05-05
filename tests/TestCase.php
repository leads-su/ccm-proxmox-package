<?php

namespace ConsulConfigManager\Proxmox\Test;

use Illuminate\Foundation\Application;
use ConsulConfigManager\Proxmox\ProxmoxDomain;
use ConsulConfigManager\Proxmox\Providers\ProxmoxServiceProvider;

/**
 * Class TestCase
 * @package ConsulConfigManager\Tasks\Test
 */
abstract class TestCase extends \ConsulConfigManager\Testing\TestCase
{
    /**
     * @inheritDoc
     */
    protected array $packageProviders = [
        ProxmoxServiceProvider::class,
    ];

    /**
     * @inheritDoc
     */
    protected bool $configurationFromEnvironment = true;

    /**
     * @inheritDoc
     */
    protected string $configurationFromFile = __DIR__ . '/..';

    /**
     * @inheritDoc
     */
    public function runBeforeSetUp(): void
    {
        ProxmoxDomain::registerRoutes();
    }

    /**
     * @inheritDoc
     */
    public function runBeforeTearDown(): void
    {
        ProxmoxDomain::ignoreRoutes();
    }

    /**
     * @inheritDoc
     */
    public function setUpEnvironment(Application $app): void
    {
    }
}
