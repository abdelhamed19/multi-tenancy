<?php

namespace App\Console\Commands\Migrate;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateTenant extends Command
{
    protected $signature = 'tenants:migrate';

    protected $description = 'Run migrations for all tenants';

    public function handle()
    {
        $tenants = Tenant::all(); // Retrieve all tenants

        $tenants->each(function ($tenant) {
            (new TenantService())->switchToTenant($tenant);

            $this->info('Starting migration for tenant: ' . $tenant->name);
            $this->info('---------------------------');
            Artisan::call('migrate', [
                '--path' => 'database/migrations/',
                '--database' => 'tenant',
            ]);

            // Output the migration result
            $this->info(Artisan::output());
        });

        return Command::SUCCESS;
    }
}
