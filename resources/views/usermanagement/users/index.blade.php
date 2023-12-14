@extends('layouts.app')
@section('content')
<div class="row" style="min-height: 75vh">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <a href="{{ route('user.create') }}" class="btn btn-sm btn-dark float-end m-0"><i class="fas fa-plus"></i> <span>Add {{ $title }}</span></a>
          <h6 class="fw-bold text-dark">{{ $title }} Table</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
          @endif
          <div class="table-responsive p-4">
            <table id="user-table" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Pegawai</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>No.Hp</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @if (count($users) > 0) 
                    @foreach ($users as $key => $row)
                    <tr>
                      <td class="align-middle text-center" style="width: 10%">
                        <span class="text-dark">{{ $key + 1 }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->no_pegawai }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->name }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->email }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->no_hp }}</span>
                      </td>
                      <td class="align-middle">
                        <span class="text-dark">{{ $row->alamat }}</span>
                      </td>
                      <td class="align-middle" style="width: 20%">
                        <a href="{{ route('user.edit', ['user' => $row->id]) }}" class="btn btn-info m-0">
                          <i class="fa fa-pen"></i>
                        </a>
                        <form action="{{ route('user.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin?');" style="display: inline-block;">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          {{-- <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></span></button> --}}
                          <button type="submit" class="btn btn-danger m-0">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
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
        $('#user-table').dataTable({
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