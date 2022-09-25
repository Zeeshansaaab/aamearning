<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $limit = \config()->get('settings.pagination_limit');
        $deposits = Deposit::with(['gateway' => function($query) use($type){
                $query->whereType($type);
        }, 'user'])->latest()->where(function($query){
            if(request()->keyword){
                $query->whereHas('user', function($query){
                    $query->where('name', 'LIKE', '%' . request()->keyword .'%')
                   ->orWhere('username', 'LIKE', '%' . request()->keyword .'%');
                });
            }
            if(request()->status){
                $query->whereStatus(request()->status);
            }
        })->paginate($limit);
        return Inertia::render('Deposit/Index', [
            'deposits' => $deposits,
            'searchKeyword' => request()->keyword,
            'filterStatus' => request()->status,
            'type' => $type
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        $deposit = Deposit::with(['user', 'media', 
                'gateway' => function($query){
                    $query->with(['single_currency' => function($query){ $query->with('media'); }]);
                }])->firstOrFail();
        return Inertia::render('Deposit/Details', ['deposit' => $deposit, 'type' => $type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function statusChange(Deposit $deposit, $status){
        $deposit->status = $status;
        $deposit->save();
        return redirect()->back();
    }
}
