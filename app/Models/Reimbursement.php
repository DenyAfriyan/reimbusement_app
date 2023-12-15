<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $table = "reimbursements";
    protected $fillable = [
        "no_referensi",
        "user_id",
        "kategori_pengeluaran_id",
        "metode_pembayaran_id",
        "tanggal_pengajuan",
        "jumlah_pengeluaran",
        "bukti_pengeluaran",
        "status_pengajuan",
        "notes",
        "disetujui_oleh",
        "tanggal_persetujuan",
   ];
}
