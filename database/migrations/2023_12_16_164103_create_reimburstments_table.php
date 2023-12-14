<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->string('no_referensi');
            $table->foreignId('user_id')->constrained(table: 'users');
            $table->foreignId('kategori_pengeluaran_id')->constrained(table:'kategori_pengeluaran');
            $table->foreignId('metode_pembayaran_id')->constrained(table:'metode_pembayaran');
            $table->date('tanggal_pengajuan');
            $table->double('jumlah_pengeluaran');
            $table->string('bukti_pengeluaran');
            $table->integer('status_pengajuan');
            $table->text('notes')->nullable();
            $table->string('disetujui_oleh')->nullable();
            $table->date('tanggal_persetujuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursements');
    }
};
