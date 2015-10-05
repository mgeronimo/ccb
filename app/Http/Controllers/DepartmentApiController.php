<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Department;
use App\Region;
use App\Province;

class DepartmentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $depts = Department::all();

        foreach ($depts as $key => $dept) {
            $dept->region = Region::where('regcode', $dept->regcode)->pluck('regname');
            $dept->province = Province::where('provcode', $dept->provcode)->pluck('provname');
        }

        return response()->json(['data' => $this->transform($depts)], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Transforms department list
     *
     * @param  int  $id
     * @return Response
     */
    private function transform($depts)
    {
        return array_map(function($depts){
            return [
                'id'            => $depts['id'],
                'name'          => $depts['dept_name'],
                'region'          => $depts['region'],
                'province'          => $depts['province'],
                //'description'   => $depts['description'],
                'is_member'     => $depts['is_member']
            ];
        }, $depts->toArray());
    }    
}
