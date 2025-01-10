<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ladies;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LadiesStoreRequest;
use App\Http\Requests\Dashboard\LadiesUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class LadiesController extends Controller
{
    public function index()
    {
        DB::beginTransaction();

        try {
            $ladies = Ladies::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            DB::commit();

            return $this->success('Ladies list is successfully retrived', $ladies);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function store(LadiesStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $payload = collect($request->validated())
                ->toArray();    
            $ladies = Ladies::create($payload);

            DB::commit();

            return $this->success('Ladies is successfully created', $ladies);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {
            $ladies = Ladies::findOrFail($id);

            DB::commit();

            return $this->success('Ladies is successfully retrived', $ladies);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(LadiesUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $ladies = Ladies::findOrFail($id);
            $payload = collect($request->validated())
                ->toArray();
            $ladies->update($payload);

            DB::commit();

            return $this->success('Ladies is successfully updated', $ladies);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $ladies = Ladies::findOrFail($id);
            $ladies->delete();

            DB::commit();

            return $this->success('Ladies is successfully deleted', $ladies);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
