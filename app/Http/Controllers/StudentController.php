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
    public function index(Request $request)
    {
        // ambil data dari key search_nama bagian params nya postman
        $search = $request->search_nama;
        // ambil data dari key limit bagian params nya postman
        $limit = $request->limit;
        // cari data berdasarkan yang di searc
        $students = Student::where('nama', 'LIKE', '%'.$search.'%')->limit($limit)->get();
        // ambil semua data melalui model
        // $students = Student::all();
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
            // validasi data
            $request->validate([
                'nama' => 'required|min:3',
                'nis' => 'required|numeric',
                'rombel' => 'required',
                'rayon' => 'required',
            ]);
            // ngirim data baru ke table students lewat model Student
            $student = Student::create([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'rombel' => $request->rombel,
                'rayon' => $request->rayon,
            ]);
            // cari data baru yang berhasil di simpen, cari berdasarkan id lewat data id dari $student yg di atas
            $hasilTambahData = Student::where('id', $student->id)->first();
            if ($hasilTambahData) {
                return ApiFormatter::createAPI(200, 'success', $student);
            }else {
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch(Exception $error) {
            // munculin deskripsi error yg bakal tampil di property data jsonnya
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
    }

    public function createToken()
    {
        return csrf_token();
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // coba baris kode didalam try
        try {
            // ambil data dari table students yang id nya sama kaya $id dari path routenya
            // where & find fungsi mencari, bedanya : where nyari berdasarkan column apa aja boleh, kalau find cuman bisa cari berdasarkan id
            $student = Student::find($id);
            if ($student) {
                // kalau data berhasil diambil, tampilkan data dari $student nya dengan tanda status code 200
                return ApiFormatter::createAPI(200, 'success', $student);
            }else {
                // kalau data gagal diambil/data gaada, yg dikembaliin status code 400
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch (Exception $error) {
            // kalau pas try ada error, deskripsi error nya ditampilkan dengan status code 400
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
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
    public function update(Request $request, $id)
    {
        try {
            // cek validasi inputan pada body postman
            $request->validate([
                'nama' => 'required|min:3',
                'nis' => 'required|numeric',
                'rombel' => 'required',
                'rayon' => 'required',
            ]);
            // ambil data yang akan di ubah
            $student = Student::find($id);
            // update data yang telah diambil diatas
            $student->update([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'rombel' => $request->rombel,
                'rayon' => $request->rayon,
            ]);
            // cari data yang berhasil diubah tadi, cari berdasarkan id dari $student yg ngambil data diawal
            $dataTerbaru = Student::where('id', $student->id)->first();
            if ($dataTerbaru) {
                // jika update berhasil, tampilkan data dari $updateStudent diatas (data yg sudah berhasil diubah)
                return ApiFormatter::createAPI(200, 'success', $dataTerbaru);
            }else {
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch (Exception $error) {
            // jika di baris kode try ada trouble, error dimunculkan dengan desc err nya dengan sttaus code 400
            return ApiFormatter::createAPI(400, 'error', $error->getMessage()); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // ambil data yang mau dihapus
            $student = Student::find($id);
            // hapus data yg diambil diatas
            $cekBerhasil = $student->delete();
            if ($cekBerhasil) {
                // kalau berhasil hapus, data yg dimunculin teks konfirm dengan status code 200
                return ApiFormatter::createAPI(200, 'success', 'Data terhapus!');
            }else {
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch (Exception $error) {
            // kalau ada trouble di baris kode dalem try, error desc nya dimunculin
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
    }
}
