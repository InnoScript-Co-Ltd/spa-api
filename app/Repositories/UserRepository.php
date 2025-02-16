<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function create(array $userData)
    {
        DB::beginTransaction();

        try {
            $userData['password'] = Hash::make($userData['password']);
            $user = $this->model->create($userData);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($id, array $userData)
    {
        DB::beginTransaction();

        try {
            $user = $this->model->findOrFail($id);

            if (isset($userData['password'])) {
                $userData['password'] = Hash::make($userData['password']);
            }

            $user->update($userData);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $user = $this->model->findOrFail($id);
            $user->delete();
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function checkEmailExists($email): bool
    {
        return $this->model->whereEmail($email)->count() > 0;
    }

    public function paginate(int $perPage)
    {
        return $this->model->paginate($perPage);
    }
}
