<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page'] = 'exam';
        $data['page_title'] = 'Exam List';
        $data['add_title'] = 'Add New Exam';
        $data['update_title'] = 'Update Exam Info';
        $data['add_modal_title'] = 'Add New Exam';
        $data['reset'] = 'exam.index';

        $data['value'] = Exam::with('createdByName');
        if ($request->has('search')){
            $sort_search = $request->search;
            $data['value'] = $data['value']->where('title', 'like', '%'.$sort_search.'%');
        }
        $data['value'] = $data['value']->orderBy('id','DESC')->paginate(15);

        return view('exam',compact('data'));
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
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['status'] = 'Active';

        $insert = Exam::create($data);

        if ($insert){
            toastr()->success('Data insert successfully');
            return redirect()->route('exam.index');
        }else{
            toastr()->success('Something went to wrong.');
            return redirect()->route('exam.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        Exam::find($id)->update($data);

        toastr()->success('Data updated successfully.');
        return redirect()->route('exam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }

    public function exam_delete(Request $request){
        $data = Exam::find($request->id);
        if ($data){
            $data->delete();
            return 1;
        }
        return 0;
    }

    public function update_status(Request $request) {
        $data = Exam::findOrFail($request->id);
        $data->status = $request->status;
        if ($data->save()) {
            return 1;
        }
        return 0;
    }
}
