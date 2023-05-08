<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
// import
use App\Helpers\ApiFormatter;
use Exception;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil semua data melalui model
        $students = Student::all();
        if ($students) {
            // kalau data berhasil diambil
            return ApiFormatter::createAPI(200, 'success', $students);
        }else {
            // kalau data gagal diambil
            return ApiFormatter::createAPI(400, 'failed');
        }
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|min:3',
                'nis' => 'required|numeric',
                'rombel' => 'required',
                'rayon' => 'required',
            ]);

            $student = Student::create([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'rombel' => $request->rombel,
                'rayon' => $request->rayon,
            ]);
            $hasilTambahData = Student::where('id', $student->id)->first();
            if ($hasilTambahData) {
                return ApiFormatter::createAPI(200, 'success', $student);
            }else {
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch(Exception $error) {
            return ApiFormatter::createAPI(400, 'error', $error);
        }
    }

    public function createToken()
    {
        return csrf_token();
    }
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
