<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\UserBonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = \config()->get('settings.pagination_limit');
        
        $userBonuses = UserBonus::with(
            [
                'user' => function($query){
                    $query->select(['name', 'username', 'firstname', 'lastname', 'id', 'plan_id']);
                        if(request()->keyword){
                            $query->where('username', 'LIKE', '%' . request()->keyword .'%')
                            ->orWhere('firstname', 'LIKE', '%' . request()->keyword .'%')
                            ->orWhere('lastname', 'LIKE', '%' . request()->keyword .'%')
                            ->orWhere('name', 'LIKE', '%' . request()->keyword .'%');
                        }
                        $query->with('plan', function($subQuery){
                            $subQuery->select(['name', 'id']);
                        });
                    },
                'bonusplan' => function($query){
                    $query->select(['id', 'name', 'amount']);
                    if(request()->keyword){
                        // $query->where('name', 'LIKE', '%' . request()->keyword .'%');
                    }
                }
            ])->where(function($query){
                if(request()->status)
                    $query->whereStatus(request()->status);
            })->paginate($limit);
        return Inertia::render('UserBonus/Index', [
            'userBonuses' => $userBonuses,
            'searchKeyword' => request()->keyword,
            'filterStatus' => request()->status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBonus  $userBonus
     * @return \Illuminate\Http\Response
     */
    public function show(UserBonus $userBonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBonus  $userBonus
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBonus $userBonus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserBonus  $userBonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBonus $userBonus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBonus  $userBonus
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBonus $userBonus)
    {
        //
    }

    public function changeAll(Request $request)
    {
        try{
            DB::beginTransaction();
            $userBonuses = UserBonus::whereIn('id', $request->selected)->get();
            foreach($userBonuses as $bonus){
                // if($bonus->bonusplan->status){
                    $bonus->update(['status' => $request->status]);
                    $bonus->user->balance =  $bonus->user->balance + $bonus->amount;
                    $bonus->user->save();
                    $bonus->user->transactions()->create([
                        'amount' => $bonus->bonusplan->amount,
                        'admin_id' => auth()->user()->id,
                        'trx_type' => '+',
                        'charge' => 0,
                        'details' =>'Earn amount from Bonus',
                        'remark'=>'earn',
                        'post_balance'=> $bonus->user->balance,
                        'trx' => getTrx(),
                        'remarks' => 'bonus'
                    ]);
                // }
            }
            DB::commit();
            flash("Bonus updated", 'success');
            return redirect()->back();
        }catch(Exception $e){
            DB::commit();
            flash($e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
