<?php

namespace App\Http\Controllers;

use App\Models\poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoliController extends Controller
{
    function index()
    {
        $poli = poli::all();

        $response = [
            'success' => true,
            'message' =>'List Poli',
            'data'    => $poli
        ];
        return response()->json($response,200);
    }

    function store(Request $request)
    {
        $kode = "";
        $response = [];

        $validator = validator::make($request->all(), [
            "poli"=> "required",
        ]);
        
        if ($validator->fails()) {
            $kode = 401;
            $response = [
                "success"=> false,
                "massage"=> "semua kolom wajib diisi",
                "data" => $validator->error()
            ];
        } else {
            $poli = Poli::create([
            'poli' => $request->input('poli'),
            ]);

            if ($poli) {
                $kode = 201;
                $response = [
                    "success"=> true,
                    "massage"=> "poli berhasil disimpan",
                    "data" => $poli
                ];
            } else {
            $kode = 201;
                $response = [
                    "success"=> false,
                    "massage"=> "poli gagal disimpan",
                    "data" => ''
                ];
            }
        }
        return response()->json($response, $kode);
    }
    
    function show($id){
        $poli = Poli::find($id);

        if ($poli) {
            $kode = 200;
            $response = [
                'success'=> true,
                'massage'=> 'detail poli',
                'data'=> $poli
            ];
        } else {
            $kode = 404;
            $response = [
                'success'=> false,
                'massage'=> 'poli tidak ditemukan',
                'data'=> ''
            ] ;
        }
        return response()->json($response, $kode);
        
    }
    

    function destroy($id){  
        $poli = Poli::whereId($id)->First();

        if ($poli != null) {
            $poli->delete();
            $kode = 200;
            $response = [
                'success'=> true,
                'massage'=> 'poli Berhasil Dihapus',
                'data' => ''
            ];
        } else {
            $kode = 404;
            $response = [
                'success'=> false,
                'massage'=> 'poli gagal dihapus',
                'data'=> ''
            ] ;
        }
        return response()->json($response, $kode);
    }

    function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'poli'=> 'required',
        ]);

        if ($validator->fails()) {
            $kode = 401;
            $response = [
                'success'=> false,
                'massage'=> 'semua kolom wajib diisi',
                'data'=> $validator->errors()
            ];
        } else {
            $poli = Poli::whereId($id)->update([
                'poli'=> $request->input('poli'),
            ]);
            if ($poli) {
                $kode = 400;
                $response = [
                    'success'=> true,
                    'massage'=> 'poli berhasil di update',
                    'data'=> $poli
                ] ;
            } else {
                $kode = 404;
                $response = [
                    'success'=> false,
                    'massage'=> 'poli gagal diupdate',
                    'data'=> ''
                ] ;
            }

        }
        return response()->json($response, $kode);
    }
}
?>