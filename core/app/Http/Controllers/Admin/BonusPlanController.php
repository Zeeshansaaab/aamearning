<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\BonusPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BonusPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = \config()->get('settings.pagination_limit');
        $bonuses = BonusPlan::where(function($query){
            if(request()->keyword){
                $query->where('name', 'LIKE', '%' . request()->keyword .'%');
            }
            if(request()->status){
            $query->where('name', 'LIKE', '%' . request()->keyword .'%');
            }
        })->paginate($limit);
        return Inertia::render('Bonus/Index', [
            'bonuses' => $bonuses,
            'searchKeyword' => request()->keyword
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
        try{
            DB::beginTransaction();
            BonusPlan::updateOrCreate(['id' => $request->input('id')], $request->all());
            DB::commit();
            flash($request->input('id') ? "Bonus Plan Updated successfully" : "Bonus plan created successfully" , 'success');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollBack();
            flash($e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonusPlan  $bonusPlan
     * @return \Illuminate\Http\Response
     */
    public function show(BonusPlan $bonusPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonusPlan  $bonusPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(BonusPlan $bonusPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonusPlan  $bonusPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BonusPlan $bonusPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonusPlan  $bonusPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonusPlan $bonusPlan)
    {
        //
    }
}
