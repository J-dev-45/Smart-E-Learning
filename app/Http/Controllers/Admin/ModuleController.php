<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modules;
use App\Models\RecentActivity;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function addModule(Request $request){
        $input = $request->validate([
            'subject_id' => 'required|uuid',
            'module_name' => 'required|string|max:255'
        ]);

        $maxOrder = Modules::where('subject_id', $input['subject_id'])->max('order');
        $nextOrder = is_null($maxOrder) ? 1 : $maxOrder + 1;
        $module = Modules::create([
            'order' => $nextOrder,
            'subject_id' => $input['subject_id'],
            'module_name' => $input['module_name']
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'added_module',
            'subject' => $request->subject_name,
            'module' => $input['module_name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'module added Successfully',
            'new_modules' => $module
        ]);

    }

    public function editModule(Request $request){
        $input = $request->validate([
            'new_module_name' => 'required|string|max:255'
        ]);
        $module = Modules::find($request->module_id);

        $module->update([
            'module_name' => $input['new_module_name']
        ]);

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'edited_module',
            'subject' => $request->subject_name,
            'module' => $input['new_module_name']
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Module updated successfully!'
        ]);

    }

    public function deleteModule(Request $request)
    {
        $module = Modules::find($request->module_id);

        if (!$module) {
            return response()->json([
                'success' => false,
                'message' => 'module not found!'
            ], 444);
        }

        $moduleName = $module->module_name;
        $moduleId = $module->id;

        $module->delete();

        RecentActivity::create([
            'name' => auth()->user()->name,
            'action' => 'deleted_module',
            'subject' => $request->subject_name,
            'module' => $moduleName
        ]);

        return response()->json([
            'success' => true,
            'message' => 'module deleted Successfully!',
            'deleted_module_id' => $moduleId
        ]);
    }
}
