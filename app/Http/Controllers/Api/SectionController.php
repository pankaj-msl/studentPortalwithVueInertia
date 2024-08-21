<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ListSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;

class SectionController extends Controller
{
    public function index(ListSectionRequest $request){
        $class_id = $request->class_id;
        return SectionResource::collection(Section::where('class_id', $class_id)->get());
    }
}
