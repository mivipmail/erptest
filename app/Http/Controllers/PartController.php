<?php

namespace App\Http\Controllers;

use App\Http\Resources\PartResource;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::with(['source', 'parts'])
            ->orderBy('order_idx', 'ASC')
            ->get();

        return response()->json(PartResource::collection($parts));
    }


    public function move(string $id) 
    {
        try {
            $part = Part::find((int)$id);
            if (!$part)
                return response()->json(['message' => "Запись с id=$id не найдена", 404]);
    
            $isUp = request()->get('up');
    
            DB::beginTransaction();

            if ($isUp) {
                $previous = Part::where('order_idx', $part->order_idx - 1)->first();
                if ($previous) {
                    $previous->order_idx ++;
                    $previous->save();

                    $part->order_idx --;
                    $part->save();
                }
            }
            else if (!$isUp) {
                $next = Part::where('order_idx', $part->order_idx + 1)->first();
                if ($next) {
                    $next->order_idx --;
                    $next->save();

                    $part->order_idx ++;
                    $part->save();
                }
            }

            $parts = Part::with(['source', 'parts'])
            ->orderBy('order_idx', 'ASC')
            ->get();

            DB::commit();
            return response()->json(PartResource::collection($parts));
        }
        catch (\Exception $e) {
            DB::rollBack();
            response()->json(['message' => $e->getMessage()], 400);
        }
    }


    public function destroy(string $id)
    {
        try {
            $part = Part::find((int)$id);
            if (!$part)
                return response()->json(['message' => "Запись с id=$id не найдена", 404]);
    
            DB::beginTransaction();

            Part::where('order_idx', '>', $part->order_idx)->decrement('order_idx', 1);
            $part->delete();
    
            $parts = Part::with(['source', 'parts'])
                ->orderBy('order_idx', 'ASC')
                ->get();

            DB::commit();
            return response()->json(PartResource::collection($parts));
        }
        catch (\Exception $e) {
            DB::rollBack();
            response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
