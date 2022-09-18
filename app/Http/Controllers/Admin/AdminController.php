<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\Referral;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function referrals()
    {
        $referrals = Referral::get();
        $settings = GeneralSetting::where('group', 'referrals')->get();
        return Inertia::render('Referrals/Index', [
            'referrals' => $referrals,
            'settings' => $settings,
            'searchKeyword' => request()->keyword
        ]);

    }

    public function referralsUpdate(Request $request)
    {
        try{
            $this->validate($request, [
                'level*' => 'required|integer|min:1',
                'percent*' => 'required|numeric',
            ]);
            
            Referral::truncate();
            
            DB::beginTransaction();
            for ($i = 0; $i < count($request->level); $i++){
                Referral::create([
                    'level' => $i + 1,
                    'percent' => $request->percent[$i],
                    'status' => 1,
                ]);
            }
            DB::commit();
            flash('Referral Commission Setting Updated Successfully' , 'success');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollBack();
            flash($e->getMessage() , 'error');
            return redirect()->back();
        }
    }

    public function statusChanger(GeneralSetting $setting)
    {
        try{
            $setting->value = $setting->value ? 0 : 1;
            $setting->save();
            flash('Status changed!!' , 'success');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollBack();
            flash($e->getMessage() , 'error');
            return redirect()->back();
        }
    }
}
