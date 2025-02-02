<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserStoreRequest;
use App\Http\Requests\Dashboard\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        DB::beginTransaction();

        try {
            $user = User::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            DB::commit();

            return $this->success('User list is successfully retrived', $user);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $payload = collect($request->validated())
                ->put('password', bcrypt($request->password))
                ->toArray();
            $user = User::create($payload);

            DB::commit();

            return $this->success('User is successfully created', $user);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            DB::commit();

            return $this->success('User is successfully retrived', $user);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $payload = collect($request->validated())
                ->toArray();
            $user->update($payload);

            DB::commit();

            return $this->success('User is successfully updated', $user);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();

            return $this->success('User is successfully deleted', $user);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
