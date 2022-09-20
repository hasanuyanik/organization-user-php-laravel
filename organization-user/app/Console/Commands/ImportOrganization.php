<?php

namespace App\Console\Commands;

use App\Http\Repositories\OrganizationRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Services\OrganizationService;
use App\Http\Services\UserService;
use App\Jobs\CreateUserAndAddOrganization;
use App\Models\Organization;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;

class ImportOrganization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:organization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing csv datas in storage/organization.csv';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Organization import starting...');

        $organizations = Excel::toArray(new User(), 'organizations20.csv');

        foreach($organizations[0] as $organization) {
    
            try
            {
                CreateUserAndAddOrganization::dispatch(
                    $organization,
                    new OrganizationService(new OrganizationRepository),
                    new UserService(new UserRepository)
                );
            } catch (Exception $exception)
            {
                Log::error($exception);

                $this->error('Failed to operate for '.$organization[0]);
            }
            
        }
        
        $this->info('Finish');
    }
}
