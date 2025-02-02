<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ladies;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Dashboard\LadiesStoreRequest;
use App\Http\Requests\Dashboard\LadiesUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class LadiesController extends ApiController
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

            return $this->successResponse($ladies, 'Ladies list is successfully retrived');
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

            return $this->successResponse($ladies, 'Ladies is successfully created');
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

            return $this->successResponse($ladies ,'Ladies is successfully retrived');
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

            return $this->successResponse($ladies, 'Ladies is successfully updated');
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

            return $this->successResponse($ladies, 'Ladies is successfully deleted');
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
