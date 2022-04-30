<?php

namespace App\Http\Controllers;
use App\Models\Blueprint;
use App\Http\Resources\BlueprintResource;

use Illuminate\Http\Request;

class BlueprintController extends Controller
{
    public function index(Request $request){
        $blueprints = Blueprint::with(['item', 'product', 'materials'])
            ->paginate(($request->limit>0) ? $request->limit : 10);
        return BlueprintResource::collection($blueprints);
    }

    public function show(Blueprint $blueprint){
        return new BlueprintResource($blueprint);
    }

    public function search($keyword){
        $blueprints = Blueprint::wherehas('item', function($query) use ($keyword){ return $query->where('typeName', 'like', '%'.$keyword.'%');} )
            ->get();
        return BlueprintResource::collection($blueprints);
    }
}
