<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    public function updateByEmail($array, $email)
    {
        return $this->model->where('email', $email)->update($array);
    }

    public function findByEmail($email, $fields = ['*'])
    {
        return $this->model->where('email', $email)->first($fields);
    }
}
