<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProxmoxVirtualMachinesTable
 */
class CreateProxmoxVirtualMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('proxmox_virtual_machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vm_id');
            $table->string('node');
            $table->string('generation_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('numa');
            $table->unsignedInteger('sockets');
            $table->unsignedInteger('cores');
            $table->unsignedInteger('memory');
            $table->string('disk_0_size')->nullable();
            $table->string('disk_0_type')->nullable();
            $table->string('disk_1_size')->nullable();
            $table->string('disk_1_type')->nullable();
            $table->string('disk_2_size')->nullable();
            $table->string('disk_2_type')->nullable();
            $table->string('disk_3_size')->nullable();
            $table->string('disk_3_type')->nullable();
            $table->string('network_0_device')->nullable();
            $table->string('network_0_mac')->nullable();
            $table->string('network_0_type')->nullable();
            $table->string('network_0_bridge')->nullable();
            $table->string('network_1_device')->nullable();
            $table->string('network_1_mac')->nullable();
            $table->string('network_1_type')->nullable();
            $table->string('network_1_bridge')->nullable();
            $table->string('network_2_device')->nullable();
            $table->string('network_2_mac')->nullable();
            $table->string('network_2_type')->nullable();
            $table->string('network_2_bridge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('proxmox_virtual_machines');
    }
}
