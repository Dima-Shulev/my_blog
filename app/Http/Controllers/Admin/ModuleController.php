<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request){
        $modules = Module::select(['id','name','position','active','template_id'])->orderBy('id','ASC')->get();
        return view('admin.modules.index',compact('modules'));
    }

    public function publicModules($id,$active){
        public_item($id,$active,Module::class);
        return redirect()->route('admin.modules');
    }
}
