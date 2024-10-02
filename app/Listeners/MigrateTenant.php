<?php

namespace App\Listeners;

use App\Services\TenantService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Console\Command\Command;
use App\Console\Commands\Migrate\MigrateTenant as MigrateTenantCommand;

class MigrateTenant
{
    public $tenant;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->tenant = $event->tenant;
        (new TenantService())->switchToTenant($this->tenant);

            Artisan::call('migrate', [
                '--path' => 'database/migrations/',
                '--database' => 'tenant',
            ]);


        // return Command::SUCCESS;
    }
}
