@extends('layouts.app')
@section('content')
<div class="row" style="min-height: 75vh">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h6 class="fw-bold text-dark">Add {{ $title }}</h6>
              </div>
            <div class="card-body">
                @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li class="text-white">{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="no_pegawai" class="form-label">Nomor Pegawai</label>
                      <input type="number" class="form-control" id="no_pegawai" name="no_pegawai" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="no_hp" class="form-label">No Hp</label>
                      <input type="number" class="form-control" id="no_hp" name="no_hp" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="alamat" class="form-label">Alamat</label>
                      <Textarea class="form-control" id="alamat" name="alamat"></Textarea>
                    </div>
                    <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select name="role" id="role" class="form-control">
                        @foreach ($role  as $key => $row)
                        <option value="{{ $row }}">{{ $key }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="departement_id" class="form-label">Departement</label>
                      <select name="departement_id" id="departement_id" class="form-control">
                        @foreach ($departement  as $key => $row)
                        <option value="{{ $row }}">{{ $key }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="jabatan_id" class="form-label">Jabatan</label>
                      <select name="jabatan_id" id="jabatan_id" class="form-control">
                        @foreach ($jabatan  as $key => $row)
                        <option value="{{ $row }}">{{ $key }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Konfirmasi Password</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection