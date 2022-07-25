<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketModel extends Model
{
    use HasFactory;
    protected $table="tiket";
    protected $fillable =['no_tiket','id_mahasiswa','id_staff','keterangan','verifikasi'];

    public function mahasiswaRole()
    {
        return $this->belongsTo(TiketModel::class,'id_mahasiswa');
    }
    public function staffRole()
    {
        return $this->belongsTo(StaffModel::class,'id_staff');
    }
}
