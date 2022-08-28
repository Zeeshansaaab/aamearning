<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiteController extends Controller
{
    public function getSettings()
    {
        $settings = GeneralSetting::groupBy('group')->orderBy('id')->get();
        
        return response()->json([
            'status' => JsonResponse::HTTP_OK,
            'data' => $settings,
        ], JsonResponse::HTTP_OK);
    }

    public function edit($group){
        $settings = GeneralSetting::where('group', $group)->get();
        return Inertia::render('Settings/Index', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request){
        try{
            DB::beginTransaction();
            foreach ($request->settings as $key => $value) { 
                $name = $value['name'];
                GeneralSetting::where('id', $value['id'])->update([
                    'value' => $value['value']
                ]);
            }
            DB::commit();
            flash("Settings saved!", 'success');
            return redirect()->back();
        }catch(ModelNotFoundException $e){
            DB::rollBack();
            $e->getMessage();
        }
        catch(Exception $e){
            DB::rollBack();
            $e->getMessage();
        }
    }
}
