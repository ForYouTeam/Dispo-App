<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\StaffModel;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function getAll()
    {
        $data = StaffModel::all();
        return view('page.Staff')->with('data', $data);
    }

    public function createStaff(StaffRequest $request)
    {
        $data = $request->only([
            'nama', 'jabatan'
        ]);
        try {
            StaffModel::create($data);
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

    public function getStaff($id)
    {
        try {
            $staff = StaffModel::whereId($id)->first();
            if ($staff) {
                $response = array(
                    'data' => $staff,
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

    public function updateStaff($id, StaffRequest $request)
    {
        $data = $request->only([
            'nama', 'jabatan'
        ]);
        try {
            $staff = StaffModel::whereId($id);
            if ($staff->first()) {
                $response = array(
                    'data' => $staff->update($data),
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
