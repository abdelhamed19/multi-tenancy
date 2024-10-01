<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->string('database');
            $table->timestamps();
        });
        DB::table('tenants')->insert([
            'name'=> 'Tenant 1',
            'domain'=> 'multi-tenancy1.local',
            'database'=> 'tenant1',
        ]);
        DB::table('tenants')->insert([
            'name'=> 'Tenant 2',
            'domain'=> 'multi-tenancy2.local',
            'database'=> 'tenant2',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
