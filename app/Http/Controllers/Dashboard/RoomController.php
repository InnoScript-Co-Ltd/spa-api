<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoomStoreRequest;
use App\Http\Requests\Dashboard\RoomUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        DB::beginTransaction();

        try {
            $room = Room::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            DB::commit();

            return $this->success('Room list is successfully retrived', $room);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function store(roomStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $payload = collect($request->validated())
                ->toArray();    
            $room = Room::create($payload);

            DB::commit();

            return $this->success('Room is successfully created', $room);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {
            $room = Room::findOrFail($id);

            DB::commit();

            return $this->success('Room is successfully retrived', $room);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(roomUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $room = Room::findOrFail($id);
            $payload = collect($request->validated())
                ->toArray();
            $room->update($payload);

            DB::commit();

            return $this->success('Room is successfully updated', $room);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $room = Room::findOrFail($id);
            $room->delete();

            DB::commit();

            return $this->success('Room is successfully deleted', $room);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
