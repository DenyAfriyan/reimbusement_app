@extends('layouts.app')
@section('content')
<div class="row" style="min-height: 75vh">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h6 class="fw-bold text-dark">Edit {{ $title }}</h6>
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
                <form action="{{ route('user.update' , ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="no_pegawai" class="form-label">Nomor Pegawai</label>
                      <input type="number" class="form-control" id="no_pegawai" name="no_pegawai" value="{{ $user->no_pegawai }}">
                    </div>
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                      <label for="name" class="form-label">No. Hp</label>
                      <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                      <label for="alaamt" class="form-label">Alamat</label>
                      <Textarea class="form-control" id="alamat" name="alamat">{{ $user->alamat }}</Textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection