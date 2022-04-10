<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
 
use Datatables;

class CategoryCRUDController extends Controller
{
    public function categoryindex()
    {
        if(request()->ajax()) {
            return datatables()->of(Categories::select('*'))
            ->addColumn('action', 'category-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('category');
    }
      
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categorystore(Request $request)
    {  
 
        $categoryId = $request->id;
 
        $category   =   Categories::updateOrCreate(
                    [
                     'id' => $categoryId
                    ],
                    [
                    'category' => $request->category, 
                    ]);    
                         
        return Response()->json($category);
 
    }
      
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function categoryedit(Request $request)
    {   
        $where = array('id' => $request->id);
        $category  = Categories::where($where)->first();
      
        return Response()->json($category);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function categorydestroy(Request $request)
    {
        $category = Categories::where('id',$request->id)->delete();
      
        return Response()->json($category);
    }
}
