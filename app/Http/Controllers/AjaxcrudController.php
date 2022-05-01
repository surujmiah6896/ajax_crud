<?php

namespace App\Http\Controllers;

use App\Models\Ajaxcrud;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxcrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajax_crud.index');
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
     * @param  \App\Models\Ajaxcrud  $ajaxcrud
     * @return \Illuminate\Http\Response
     */
    public function show(Ajaxcrud $ajaxcrud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajaxcrud  $ajaxcrud
     * @return \Illuminate\Http\Response
     */
    public function edit(Ajaxcrud $ajaxcrud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajaxcrud  $ajaxcrud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajaxcrud $ajaxcrud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajaxcrud  $ajaxcrud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ajaxcrud $ajaxcrud)
    {
        //
    }
    // -------all data-------
    public function studentall(){
        $data = Ajaxcrud::orderBy('id','DESC')->get();
        return response()->json($data);
    }

    // ----------add Student--------
    public function addstudent(Request $request){
        $request->validate([
            'name' => 'required',
            'depertment' => 'required',
            'semester' => 'required',
        ]);

        $data = Ajaxcrud::insert([
            'name' => $request->name,
            'depertment' => $request->depertment,
            'semester' => $request->semester,
            'created_at' => Carbon::now(),
        ]);

        return response()->json($data);
    }

    // -----------edit Student ----------
    public function editstudent($id){
        $data = Ajaxcrud::findOrFail($id);
        return response()->json($data);
    }

    //--------update Data----------------
    public function updatestudent(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'depertment' => 'required',
            'semester' => 'required',
        ]);

        $data = Ajaxcrud::findOrFail($id)->update([
            'name' => $request->name,
            'depertment' => $request->depertment,
            'semester' => $request->semester,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json($data);
    }

    //------------deleteData-------------
    public function deletestudent($id){
        $data = Ajaxcrud::findOrFail($id)->delete();
        return response()->json($data);
    }
}
