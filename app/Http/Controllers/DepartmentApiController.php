<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
     * Show the list of agencies
     *
     * @return Response
     */
    public function getList()
    {
        $user = Auth::user();
        
        if($user->agency_id>0)
            $agencies = Department::where('id', $user->agency_id)->get();
        else $agencies = Department::all();

        $data = [];

        foreach($agencies as $agency) {
            $d['code'] = $agency->id;
            $d['name'] = $agency->dept_name;
            $d['ticked']    = false;
            $data[] = $d;
        }
        return response()->json($data);
    }

    /**
     * Show list of regions
     *
     * @return Response
     */
    public function getRegions()
    {
        $regions = Region::all();
        $data = [];

        foreach($regions as $region) {
            $d['code'] = $region->regcode;
            $d['name'] = $region->regname;
            $d['ticked']    = false;
            $data[] = $d;
        }
        return response()->json($data);
    }

    /**
     * Show list of provinces
     *
     * @return Response
     */
    public function getProvinces()
    {
        $provinces = Province::all();
        $data = [];

        foreach($provinces as $province) {
            $d['code'] = $province->provcode;
            $d['name'] = $province->provname;
            $d['ticked']    = false;
            $data[] = $d;
        }
        return response()->json($data);
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
