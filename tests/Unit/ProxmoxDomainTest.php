<?php

namespace ConsulConfigManager\Proxmox\Test\Unit;

use ConsulConfigManager\Proxmox\ProxmoxDomain;
use ConsulConfigManager\Proxmox\Test\TestCase;

/**
 * Class ProxmoxDomainTest
 * @package ConsulConfigManager\Proxmox\Test\Unit
 */
class ProxmoxDomainTest extends TestCase
{
    /**
     * @return void
     */
    public function testMigrationsShouldRunByDefault(): void
    {
        $this->assertTrue(ProxmoxDomain::shouldRunMigrations());
    }

    /**
     * @return void
     */
    public function testMigrationsPublishingCanBeDisabled(): void
    {
        ProxmoxDomain::ignoreMigrations();
        $this->assertFalse(ProxmoxDomain::shouldRunMigrations());
        ProxmoxDomain::registerMigrations();
    }

    /**
     * @return void
     */
    public function testRoutesShouldNotBeRegisteredByDefault(): void
    {
        ProxmoxDomain::ignoreRoutes();
        $this->assertFalse(ProxmoxDomain::shouldRegisterRoutes());
        ProxmoxDomain::registerRoutes();
    }

    /**
     * @return void
     */
    public function testRoutesRegistrationCanBeEnabled(): void
    {
        ProxmoxDomain::registerRoutes();
        $this->assertTrue(ProxmoxDomain::shouldRegisterRoutes());
        ProxmoxDomain::ignoreRoutes();
    }
}
