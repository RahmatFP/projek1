<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    function index()
    {
        $pasien = Pasien::all();

        $response = [
            'success' => true,
            'message' =>'List Pasien',
            'data'    => $pasien
        ];
        return response()->json($response,200);
    }

    function store(Request $request)
    {
        $kode = "";
        $response = [];
    
        $validator = Validator::make($request->all(), [
            "Nomor_rm"=> "required",
            "nama"=> "required",
            "Tanggal_Lahir"=> "required",
            "Nomor_Telepon"=> "required|Numeric",
            "Alamat"=> "required",
        ]);
        
        if ($validator->fails()) {
            $kode = 401;
            $response = [
                "success"=> false,
                "massage"=> "semua kolom wajib diisi",
                "data" => $validator->errors()
            ];
        } else {
            $pasien = Pasien::create($request->all());
    
            if ($pasien) {
                $kode = 201;
                $response = [
                    "success"=> true,
                    "massage"=> "data pasien berhasil disimpan",
                    "data" => $pasien
                ];
            } else {
            $kode = 201;
                $response = [
                    "success"=> false,
                    "massage"=> "data pasien gagal disimpan",
                    "data" => ''
                ];
            }
        }
        return response()->json($response, $kode);
    }
    
    
    function show($id){
        $pasien = Pasien::find($id);

        if ($pasien) {
            $kode = 200;
            $response = [
                'success'=> true,
                'massage'=> 'detail pasien',
                'data'=> $pasien
            ];
        } else {
            $kode = 404;
            $response = [
                'success'=> false,
                'massage'=> 'data pasien tidak ditemukan',
                'data'=> ''
            ] ;
        }
        return response()->json($response, $kode);
        
    }
    

    function destroy($id){  
        $pasien = Pasien::whereId($id)->First();

        if ($pasien != null) {
            $pasien->delete();
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
            "Nomor_rm"=> "required",
            "nama"=> "required",
            "Tanggal_Lahir"=> "required",
            "Nomor_Telepon"=> "required|Numeric",
            "Alamat"=> "required",
        ]);

        if ($validator->fails()) {
            $kode = 401;
            $response = [
                'success'=> false,
                'massage'=> 'semua kolom wajib diisi',
                'data'=> $validator->errors()
            ];
        } else {
            $pasien = Pasien::whereId($id)->update([
                'nama'=> $request->input('nama'),
                "Nomor_rm"=> $request->input('Nomor_rm'),
                "Tanggal_Lahir"=> $request->input('Tanggal_Lahir'),
                "Nomor_Telepon"=> $request->input('Nomor_Telepon'),
                "Alamat"=> $request->input('Alamat'),
            ]);
            if ($pasien) {
                $kode = 400;
                $response = [
                    'success'=> true,
                    'massage'=> 'data pasien berhasil di update',
                    'data'=> $pasien
                ] ;
            } else {
                $kode = 404;
                $response = [
                    'success'=> false,
                    'massage'=> 'data pasien gagal diupdate',
                    'data'=> ''
                ] ;
            }

        }
        return response()->json($response, $kode);
    }
}
?> -->