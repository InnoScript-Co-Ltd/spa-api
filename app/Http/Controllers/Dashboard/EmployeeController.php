<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EmployeeController extends ApiController
{
    public function index () {

        DB::beginTransaction();
        try {

            $employee = Employee::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            DB::commit();

            return $this->successResponse($employee, 'Employee list is successfully retrived');
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

    }
}
