<?php

namespace ConsulConfigManager\Proxmox\Providers;

use Illuminate\Support\Facades\Route;
use ConsulConfigManager\Proxmox\Commands;
use ConsulConfigManager\Proxmox\UseCases;
use ConsulConfigManager\Proxmox\Interfaces;
use ConsulConfigManager\Proxmox\Presenters;
use ConsulConfigManager\Proxmox\Repositories;
use ConsulConfigManager\Proxmox\ProxmoxDomain;
use ConsulConfigManager\Proxmox\Http\Controllers;
use ConsulConfigManager\Domain\DomainServiceProvider;

/**
 * Class ProxmoxServiceProvider
 * @package ConsulConfigManager\Proxmox\Providers
 */
class ProxmoxServiceProvider extends DomainServiceProvider
{
    /**
     * List of commands provided by package
     * @var array
     */
    protected array $packageCommands = [
        Commands\SynchronizeVirtualMachinesListCommand::class,
    ];

    /**
     * List of repositories provided by package
     * @var array
     */
    protected array $packageRepositories = [
        Interfaces\VirtualMachineRepositoryInterface::class             =>  Repositories\VirtualMachineRepository::class,
    ];


    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->offerPublishing();
        $this->registerMigrations();
        $this->registerCommands();
        parent::boot();
    }

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->registerConfiguration();
        parent::register();
    }

    /**
     * Register package routes
     * @return void
     */
    protected function registerRoutes(): void
    {
        if (ProxmoxDomain::shouldRegisterRoutes()) {
            Route::group([
                'prefix'        =>  config('domain.proxmox.prefix'),
                'middleware'    =>  config('domain.proxmox.middleware'),
            ], function (): void {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
            });
        }
    }

    /**
     * Register package configuration
     * @return void
     */
    protected function registerConfiguration(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/proxmox.php', 'domain.proxmox');
    }

    /**
     * Register package migrations
     * @return void
     */
    protected function registerMigrations(): void
    {
        if (ProxmoxDomain::shouldRunMigrations()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }

    /**
     * Register package commands
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->packageCommands);
        }
    }

    /**
     * Offer resources for publishing
     * @return void
     */
    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/proxmox.php'         =>  config_path('domain/proxmox.php'),
            ], 'ccm-proxmox-config');
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerFactories(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function registerRepositories(): void
    {
        foreach ($this->packageRepositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * @inheritDoc
     */
    protected function registerInterceptors(): void
    {
        $this->registerVirtualMachineInterceptors();
    }

    /**
     * Register interceptors for Virtual Machine use cases
     * @return void
     */
    private function registerVirtualMachineInterceptors(): void
    {
        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\List\ProxmoxVirtualMachineListInputPort::class,
            UseCases\VirtualMachine\List\ProxmoxVirtualMachineListInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineListController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineListHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\My\ProxmoxVirtualMachineMyInputPort::class,
            UseCases\VirtualMachine\My\ProxmoxVirtualMachineMyInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineMyController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineMyHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\Get\ProxmoxVirtualMachineGetInputPort::class,
            UseCases\VirtualMachine\Get\ProxmoxVirtualMachineGetInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineGetController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineGetHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\Status\ProxmoxVirtualMachineStatusInputPort::class,
            UseCases\VirtualMachine\Status\ProxmoxVirtualMachineStatusInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineStatusController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineStatusHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\Start\ProxmoxVirtualMachineStartInputPort::class,
            UseCases\VirtualMachine\Start\ProxmoxVirtualMachineStartInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineStartController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineStartHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\Stop\ProxmoxVirtualMachineStopInputPort::class,
            UseCases\VirtualMachine\Stop\ProxmoxVirtualMachineStopInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineStopController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineStopHttpPresenter::class,
        );

        $this->registerInterceptorFromParameters(
            UseCases\VirtualMachine\Restart\ProxmoxVirtualMachineRestartInputPort::class,
            UseCases\VirtualMachine\Restart\ProxmoxVirtualMachineRestartInteractor::class,
            Controllers\VirtualMachine\ProxmoxVirtualMachineRestartController::class,
            Presenters\VirtualMachine\ProxmoxVirtualMachineRestartHttpPresenter::class,
        );
    }
}
