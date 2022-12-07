<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konser;
use Illuminate\Http\Request;

class KonserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konser = Konser::all();

        return response()->json([
            'message' => 'Data Konser berhasil ditampilkan',
            'data' => $konser,
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        

        if ($user->role == 'admin') {
         

            $konser = Konser::create([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'tempat' => $request->tempat,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'poster' => $request->poster,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Konser berhasil ditambahkan',
                'data' => $konser,
            ], 200);

        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk menambahkan konser',
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $user = auth()-> user();

        if ($user->role =='admin'){
            $request->validate([
                'nama' => 'required',
                'tanggal' => 'required',
                'tempat' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required',
            ]);

            $konser = Konser::find($id);

            $konser->update([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'tempat' => $request->tempat,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Konser berhasil di update',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki akses untuk mengupdate konser',
            ]);
        }
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
}
