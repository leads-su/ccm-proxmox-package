<?php

use Illuminate\Support\Facades\Route;

Route::prefix('proxmox')->group(static function (): void {
    Route::prefix('vm')->group(static function (): void {
        Route::get('', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineListController::class)
            ->name('domain.proxmox.vm.list');

        Route::get('my', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineMyController::class)
            ->name('domain.proxmox.vm.my');

        Route::prefix('{node}')->group(static function (): void {
            Route::prefix('{identifier}')->group(static function (): void {
                Route::get('', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineGetController::class)
                    ->name('domain.proxmox.vm.information');

                Route::get('status', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineStatusController::class)
                    ->name('domain.proxmox.vm.status');

                Route::get('start', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineStartController::class)
                    ->name('domain.proxmox.vm.start');

                Route::get('stop', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineStopController::class)
                    ->name('domain.proxmox.vm.stop');

                Route::get('restart', \ConsulConfigManager\Proxmox\Http\Controllers\VirtualMachine\ProxmoxVirtualMachineRestartController::class)
                    ->name('domain.proxmox.vm.restart');
            });
        });
    });
});
