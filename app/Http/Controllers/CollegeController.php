<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollegeController extends Controller
{
    // 1. عرض صفحة الـ Frontend (الـ Blade)
    public function index()
    {
        return view('manage'); 
    }

    // 2. الـ API لجلب البيانات (العرض فقط)
    public function indexApi()
    {
        // جلب كل الكليات
        $colleges = College::all();
        
        // الرد بـ JSON مع حالة 200 (Success) - حسب معايير 
        return response()->json($colleges, 200);
    }

    // 3. إضافة كلية (الـ API اللي حتستخدمه زميلتك)
    public function store(Request $request)
    {
        // الـ Validation: أهم نقطة عند الدكتور (الفقرة 5.1)
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'icon'         => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'dean_name'    => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:255',
        ]);

        // لو البيانات غلط، نرجع خطأ واضح 422 (Error Handling)
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors'  => $validator->errors()
            ], 422);
        }

        $college = College::create($request->all());
        
        // حالة 201 تعني Created بنجاح
        return response()->json($college, 201);
    }

    // 4. تحديث البيانات
    public function update(Request $request, $id)
    {
        $college = College::find($id);
        
        if (!$college) {
            return response()->json(['message' => 'College not found'], 404);
        }

        $college->update($request->all());
        return response()->json($college, 200);
    }

    // 5. الحذف
    public function destroy($id)
    {
        $college = College::find($id);

        if (!$college) {
            return response()->json(['message' => 'College not found'], 404);
        }

        $college->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}