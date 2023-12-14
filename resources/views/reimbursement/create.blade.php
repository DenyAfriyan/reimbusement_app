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
                <form action="{{ route('departement.store') }}" method="POST">
                    @csrf
                    {{-- <div class="mb-3">
                      <label for="no_referensi" class="form-label">No Referensi</label>
                      <input type="text" class="form-control" id="no_referensi" name="no_referensi" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-control">
                          @foreach ($users  as $key => $row)
                          <option value="{{ $row }}">{{ $key }}</option>
                          @endforeach
                        </select>
                    </div> --}}
                    <div class="mb-3">
                        <label for="kategori_pengeluaran_id" class="form-label">Kategori Pengeluaran</label>
                        <select name="kategori_pengeluaran_id" id="kategori_pengeluaran_id" class="form-control">
                          @foreach ($kategori_pengeluaran  as $key => $row)
                          <option value="{{ $row }}">{{ $key }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_pengeluaran" class="form-label">Jumlah Pengeluaran</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="jumlah_pengeluaran" name="jumlah_pengeluaran" placeholder="Contoh : 10000">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bukti_pengeluaran" class="form-label">Bukti Pengeluaran</label>
                        <input class="form-control" type="file" id="bukti_pengeluaran" accept="image/png, image/gif, image/jpeg">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan</label>
                        <Textarea class="form-control" id="notes" name="notes"></Textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection