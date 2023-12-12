<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    function index()
    {
        $pegawai = Pegawai::all();

        $response = [
            'success' => true,
            'message' =>'List Pegawai',
            'data'    => $pegawai
        ];
        return response()->json($response,200);
    }

    function store(Request $request)
    {
        $kode = "";
        $response = [];
    
        $validator = Validator::make($request->all(), [
            "Nip"=> "required",
            "nama"=> "required",
            "tanggal_Lahir"=> "required",
            "Nomor_Telepon"=> "required|Numeric",
            "Email"=> "required",
            "Password"=> "required",
        ]);
        
        if ($validator->fails()) {
            $kode = 401;
            $response = [
                "success"=> false,
                "massage"=> "semua kolom wajib diisi",
                "data" => $validator->errors()
            ];
        } else {
            $pegawai = Pegawai::create($request->all());
    
            if ($pegawai) {
                $kode = 201;
                $response = [
                    "success"=> true,
                    "massage"=> "data pegawai berhasil disimpan",
                    "data" => $pegawai
                ];
            } else {
            $kode = 201;
                $response = [
                    "success"=> false,
                    "massage"=> "data pegawai gagal disimpan",
                    "data" => ''
                ];
            }
        }
        return response()->json($response, $kode);
    }
    
    
    function show($id){
        $pegawai = Pegawai::find($id);

        if ($pegawai) {
            $kode = 200;
            $response = [
                'success'=> true,
                'massage'=> 'detail pegawai',
                'data'=> $pegawai
            ];
        } else {
            $kode = 404;
            $response = [
                'success'=> false,
                'massage'=> 'data pegawai tidak ditemukan',
                'data'=> ''
            ] ;
        }
        return response()->json($response, $kode);
        
    }
    

    function destroy($id){  
        $pegawai = Pegawai::whereId($id)->First();

        if ($pegawai != null) {
            $pegawai->delete();
            $kode = 200;
            $response = [
                'success'=> true,
                'massage'=> 'data Berhasil Dihapus',
                'data' => ''
            ];
        } else {
            $kode = 404;
            $response = [
                'success'=> false,
                'massage'=> 'data gagal dihapus',
                'data'=> ''
            ] ;
        }
        return response()->json($response, $kode);
    }

    function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "Nip"=> "required",
            "nama"=> "required",
            "tanggal_Lahir"=> "required",
            "Nomor_Telepon"=> "required|Numeric",
            "Email"=> "required",
            "Password"=> "required",
        ]);

        if ($validator->fails()) {
            $kode = 401;
            $response = [
                'success'=> false,
                'massage'=> 'semua kolom wajib diisi',
                'data'=> $validator->errors()
            ];
        } else {
            $pegawai = Pegawai::whereId($id)->update([
                'nama'=> $request->input('nama'),
                "Nip"=> $request->input('Nip'),
                "tanggal_Lahir"=> $request->input('tanggal_Lahir'),
                "Nomor_Telepon"=> $request->input('Nomor_Telepon'),
                "Email"=> $request->input('Email'),
                "Password"=> $request->input('Password'),
                

            ]);
            if ($pegawai) {
                $kode = 400;
                $response = [
                    'success'=> true,
                    'massage'=> 'data pegawai berhasil di update',
                    'data'=> $pegawai
                ] ;
            } else {
                $kode = 404;
                $response = [
                    'success'=> false,
                    'massage'=> 'data pegawai gagal diupdate',
                    'data'=> ''
                ] ;
            }

        }
        return response()->json($response, $kode);
    }
}
?>