@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Datatables')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
@endsection

@section('content')

<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Setting {{@@$tokodata[0][0]->toko_nama}}</h4>
                    
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        {{-- <p class="card-text">DataTables has most features enabled by default, so all you need to do to
                            use it with your own tables is to call the construction function: $().DataTable();.</p> --}}
                            <form class="form" action="{{url('/save_toko')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" id="first-name-column" class="form-control" placeholder="Toko Nama" value="{{@$tokodata[0][0]->toko_nama}}"
                                          name="tnama">
                                        <label for="first-name-column">Toko Nama</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <input type="text" id="last-name-column" class="form-control" placeholder="Toko Telpon" value="{{@$tokodata[0][0]->toko_telp}}"
                                          name="ttelp">
                                        <label for="last-name-column">Toko Telpon</label>
                                      </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                      <div class="form-label-group">
                                        <input type="text" id="city-column" class="form-control" placeholder="Toko Key" name="tkey" value="{{@$tokodata[0][0]->toko_key}}">
                                        <label for="city-column">Toko Key</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <textarea class="form-control" id="label-textarea" rows="3" placeholder="Toko Alamat" name="talamat">{{@$tokodata[0][0]->toko_alamat}}</textarea>
                                        <label for="label-textarea">Toko Alamat</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                      <div class="form-label-group">
                                        <textarea class="form-control" id="label-textarea" rows="3" placeholder="Ucapan Footer Struk" name="tfooter">{{@$tokodata[0][0]->toko_struk_footer}}</textarea>
                                        <label for="label-textarea">Ucapan Footer Struk</label>
                                      </div>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                      <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                      <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                    </div>
                                  </div>
                                </div>
                              </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>

<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
    @if ($message = Session::get('success'))
        toastr.success("{{ $message }}");
    @endif
    @if ($message = Session::get('error'))
        toastr.error("{{ $message }}");
    @endif

    
</script>
@endsection