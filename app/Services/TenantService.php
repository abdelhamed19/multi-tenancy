<?php
namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class TenantService
{
    private $tenant;
    public function switchToTenant(Tenant $tenant)
    {
        if ($tenant) {
            DB::purge('system');
            DB::purge('tenant');
            Config::set('database.connections.tenant.database', $tenant->database);
            if (!$this->databaseExists($tenant->database)) {
                $this->createTenantDatabase($tenant->database);
            }
            DB::reconnect('tenant');
            DB::setDefaultConnection('tenant');
            return $tenant;
        }
        return null;
    }
    private function databaseExists($database)
    {
        try {
            DB::connection('system')->getPdo()->exec("USE `$database`");
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    private function createTenantDatabase($database)
    {
        DB::connection('system')->statement("CREATE DATABASE `$database`");
    }
    public function switchToDefault()
    {
        DB::purge('system');
        DB::purge('tenant');
        DB::reconnect('system');
        DB::setDefaultConnection('system');
    }
}
