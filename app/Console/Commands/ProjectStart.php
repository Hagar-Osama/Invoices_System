<?php

namespace App\Console\Commands;

use App\Models\Roles;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class ProjectStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to start the project by creating an admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // try{
            // Artisan::call('migrate:fresh');
            // $this->info('Database Updated');
            // Artisan::call('db:seed --class="RoleSeed"');
            // $this->info('Seeders Updated');
            // $name = $this->ask('Enter Your Name');
            // $email = $this->ask('Enter Your Email');
            // $password = $this->secret('Enter Your Pasword');
            // $role = Roles::where('name', 'admin')->first();
            // User::create([
            //     'name'=>$name,
            //     'email'=>$email,
            //     'password'=>Hash::make($password),
            //     'role_id' => $role->id
            // ]);
            // $this->info('Your Account is Created');
            // return Command::SUCCESS;

        // }catch(Exception $e) {
        //     return Command::FAILURE;

        //}
    }
}
