<?php

namespace App\Jobs;

use App\Contracts\IOrganizationService;
use App\Contracts\IUserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUserAndAddOrganization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var IOrganizationService
     */
    private IOrganizationService $organizationService;

    /**
     * @var IUserService
     */
    private IUserService $userService;

    /**
     * @var array
     */
    private array $data;

    /**
     * Create a new job instance.
     * 
     * @param array $data
     * @param IOrganizationService $organizationService
     * @param IUserService $userService
     *
     * @return void
     */
    public function __construct(array $data, IOrganizationService $organizationService, IUserService $userService)
    {
        $this->data = $data;
        $this->organizationService = $organizationService;
        $this->userService = $userService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->data[0];
        $email = $this->data[1];
        $phone = $this->data[2];
        $address = $this->data[3];

        $create = $this->userService->create([
            'name' => $name,
            'email' => $email
        ]);
        
        $this->organizationService->create([
            'uuid' => $create->uuid,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ]);
    }
}
