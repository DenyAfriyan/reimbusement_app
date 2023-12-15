@extends('layouts.app')
@section('content')
<div class="row" style="min-height: 75vh">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <div class="form-group">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    Tanggal Pengajuan
                                </th>
                                <td>
                                    {{ $reimbursement->tanggal_pengajuan ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Nama</th>
                                <td>
                                    {{ $reimbursement->user_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Kategori Pengeluaran
                                </th>
                                <td>
                                    {{ $reimbursement->kategori_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Metode Pembayaran                                </th>
                                <td>
                                    {{ $reimbursement->metode_pembayaran_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Jumlah Pengeluaran                                </th>
                                <td>
                                    {{  "Rp " . number_format($reimbursement->jumlah_pengeluaran,2,',','.') }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Bukti Pengeluaran                                </th>
                                <td>
                                    <img src="{{ asset('storage/'.$reimbursement->bukti_pengeluaran) }}" class="img-thumbnail" style="width: 200px;" alt="">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Status Pengajuan                                </th>
                                <td>
                                    @php
                                    if ($reimbursement->status_pengajuan == 0){
                                    echo '<span class="badge bg-warning">Menunggu Persetujuan Admin</span>';
                                    }elseif ($reimbursement->status_pengajuan == 1){
                                      echo '<span class="badge bg-success">Disetujui</span>';
                                    }else{
                                      echo '<span class="badge bg-danger">Ditolak</span>';
                                    }
                                  @endphp
                                </td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>
                                    {{ $reimbursement->notes ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Disetujui/Ditolak</th>
                                <td>
                                    {{ $reimbursement->tanggal_persetujuan ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Nomor Referensi</th>
                                <td>
                                    {{ $reimbursement->no_referensi ?? '-' }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <th>Disetujui Oleh</th>
                                <td>
                                    {{ $reimbursement->tanggal_persetujuan ?? '-' }}
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-primary btn-sm" href="{{ route('reimbursement.index') }}">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection