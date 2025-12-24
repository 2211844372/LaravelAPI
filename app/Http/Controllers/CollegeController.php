<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{






    public function index()
{
    // هادي الصفحة اللي حتعرض الـ Vue
    return view('manage'); // تأكدي إن ملف الـ Blade اسمه manage.blade.php
}
    /**
     * Display a listing of the resource.
     */
   public function indexApi()
{
    // هادي بتجيب كل الكليات من الداتابيز وتبعثهم كـ نص JSON
    $colleges = \App\Models\College::all(); 
    return response()->json($colleges);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request) {
    $college = College::create($request->all());
    return response()->json($college);
}
    /**
     * Display the specified resource.
     */
    public function show(College $college)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id) {
    $college = College::findOrFail($id);
    $college->update($request->all());
    return response()->json($college);
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id) {
    College::destroy($id);
    return response()->json(['message' => 'Deleted successfully']);
}
}
