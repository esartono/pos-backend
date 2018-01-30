<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use App\Repositories\UserRepository;
use Validator;
use Exception;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;

class CreateSystemAdmin extends Command
{
    protected $userRepos;
    protected $header = <<<EOF
      _       _           _
     / \   __| |_ __ ___ (_)_ __
    / _ \ / _` | '_ ` _ \| | '_ \
   / ___ \ (_| | | | | | | | | | |
  /_/   \_\__,_|_| |_| |_|_|_| |_|

EOF;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin Create';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepos)
    {
        parent::__construct();
        $this->userRepos    = $userRepos;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required',
            'email'             => 'required|unique:users,email,NULL,id,deleted_at,NULL|email',
            'password'          => 'required|min:8',
            'password_confirm'  => 'required|same:password',
        ];
    }

    /**
     * Execute the console command.
     *
     * @author tinhtn
     *
     * @return void
     */
    public function handle()
    {
        $this->info($this->header);
        $data['name']               = $this->ask("Enter Name");
        $data['email']              = $this->ask("Enter Admin Email");
        $data['password']           = $this->secret("Enter the Admin password");
        $data['password_confirm']   = $this->secret("Enter the confirm password");

        $validator = Validator::make($data, $this->rules());

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $message) {
                $this->error($message);
            }
            exit();
        }

        try {
            $user = $this->userRepos->create([
                'email'         => $data['email'],
                'name'          => $data['name'],
                'password'      => $data['password'],
            ]);

            $this->info(__('messages.success'));
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
