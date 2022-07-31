<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function getAll()
    {
        $data = MahasiswaModel::all();
        return view('page.Mahasiswa')->with('data', $data);
    }

    public function createMahasiswa(MahasiswaRequest $request)
    {
        $data = $request->only([
            'nama', 'stambuk', 'prodi', 'fakultas'
        ]);
        try {
            MahasiswaModel::create($data);
            $response = array(
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $response = array(
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($response, $response['code']);
    }

    public function getMahasiswa($id)
    {
        try {
            $mahasiswa = MahasiswaModel::whereId($id)->first();
            if ($mahasiswa) {
                $response = array(
                    'data' => $mahasiswa,
                    'message' => 'Data berhasil ditemukan',
                    'code' => 200
                );
            } else {
                $response = array(
                    'message' => 'Data tidak ditemukan',
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $response = array(
                'message' => $th->getMessage(),
                'code' => 500
            );
        }

        return response()->json($response, $response['code']);
    }

    public function updateMahasiswa($id, MahasiswaRequest $request)
    {
        $data = $request->only([
            'nama', 'stambuk', 'prodi', 'fakultas'
        ]);
        try {
            $mahasiswa = MahasiswaModel::whereId($id);
            if ($mahasiswa->first()) {
                $response = array(
                    'data' => $mahasiswa->update($data),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $response = array(
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Not found',
                        'message' => 'Data tidak ditemukan',
                    ),
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $response = array(
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($response, $response['code']);
    }

    public function deleteMahasiswa($id)
    {
        try {
            $mahasiswa = MahasiswaModel::whereId($id);
            if ($mahasiswa->first()) {
                $response = array(
                    'data' => $mahasiswa->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
                );
            } else {
                $response = array(
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Not found',
                        'message' => 'Data tidak ditemukan',
                    ),
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $response = array(
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return response()->json($response, $response['code']);
    }
}
