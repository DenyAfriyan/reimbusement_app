@extends('layouts.app')
@section('content')
<div class="row" style="min-height: 75vh">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body px-0 pt-0 pb-2">
          @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
          @endif
          <div class="table-responsive p-4">
            <table id="reimbursement-table" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Nomor Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Jumlah Pengeluaran</th>
                        <th>Status Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if (count($reimbursement) > 0) 
                    @foreach ($reimbursement as $key => $row)
                    <tr>
                      <td class="align-middle text-center" style="width: 10%">
                        <span class="text-dark">{{ $key + 1 }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->tanggal_pengajuan }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->no_pegawai }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->user_name }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{  "Rp " . number_format($row->jumlah_pengeluaran,2,',','.') }}</span>
                      </td>
                      <td class="align-middle">
                        @php
                          if ($row->status_pengajuan == 0){
                          echo '<span class="badge bg-warning">Menunggu Persetujuan Admin</span>';
                          }elseif ($row->status_pengajuan == 1){
                            echo '<span class="badge bg-success">Disetujui</span>';
                          }else{
                            echo '<span class="badge bg-danger">Ditolak</span>';
                          }
                        @endphp
                      </td>
                      <td class="align-middle" style="width: 20%">
                        @can('approval reimbursement')
                        @if ($row->status_pengajuan == 0)
                        <a href="{{ route('approval-reimbursement.show', ['approval_reimbursement' => $row->reimbursement_id]) }}" class="btn btn-info m-0">
                          <i class="fa fa-user-check"></i>
                        </a>
                        <form action="{{ route('approval-reimbursement.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin?');" style="display: inline-block;">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          {{-- <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></span></button> --}}
                          <button type="submit" class="btn btn-danger m-0">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                        @endif
                        @endcan
                        
                      </td> 
                    </tr>
                    @endforeach
                  @endif
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('custom_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function(){
        $('#reimbursement-table').dataTable({
            language: {
                'paginate': {
                'previous': '<i class="fa fa-toggle-left"></i>',
                'next': '<i class="fa fa-toggle-right"></i>'
                }
            }
        });
    })
</script>
@endsection