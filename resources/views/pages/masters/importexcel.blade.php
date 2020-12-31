@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Datatables')

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/file-uploaders/dropzone.min.css')}}">
@endsection
{{-- page-styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/file-uploaders/dropzone.css')}}">
@endsection

@section('content')

<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="col-xl-12 col-12 dashboard-order-summary">
        <div class="card">
          <div class="row">
            <!-- Order Summary Starts -->
            <div class="col-md-8 col-12 order-summary border-right pr-md-0">
              <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Template Data</h4>
                  <div class="d-flex">
                    
                     {{-- <button type="button" class="btn btn-sm btn-success glow mr-1 btn-bayar">(f2) Bayar</button>
                    <a href="{{url('clear-cart/kasir')}}" type="button" class="btn btn-sm btn-danger glow btn-clear">(f1) Clear all</a> --}}
                  </div>
                </div>
                <div class="card-content">
                  <div class="row pills-stacked">
                    <div class="col-md-2 col-sm-12">
                      <ul class="nav nav-pills flex-column text-center text-md-left">
                        <li class="nav-item">
                          <a class="nav-link active" id="stacked-pill-1" data-toggle="pill" href="#vertical-pill-1"
                            aria-expanded="true">
                            Template Items
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="stacked-pill-2" data-toggle="pill" href="#vertical-pill-2"
                            aria-expanded="false">
                            Template Kategori  
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="stacked-pill-3" data-toggle="pill" href="#vertical-pill-3"
                            aria-expanded="false">
                            Template Satuan
                          </a>
                        </li>
                        
                      </ul>
                    </div>
                    <div class="col-md-10 col-sm-12">
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="vertical-pill-1" aria-labelledby="stacked-pill-1"
                          aria-expanded="true">
                          <p>
                            Template Untuk Upload Data Items Master.</p>
                          <p>
                            Download <a href="{{url('/download-master')}}">Disini</a>
                            {{-- {{dd(storage_path().)}} --}}
                          </p>
                        </div>
                        <div class="tab-pane" id="vertical-pill-2" role="tabpanel" aria-labelledby="stacked-pill-2"
                          aria-expanded="false">
                          <p>
                            Template Ini Untuk mengambil id dari kategori, bertujuan untuk mengisi template di master item.</p>
                          <p>
                            Download <a href="{{url('/eksport-kategori')}}">Disini</a>
                          </p>
                        </div>
                        <div class="tab-pane" id="vertical-pill-3" role="tabpanel" aria-labelledby="stacked-pill-3"
                          aria-expanded="false">
                          <p>
                            Template Ini Untuk mengambil id dari satuan, bertujuan untuk mengisi template di master item.</p>
                          <p>
                            Download <a href="{{url('/eksport-satuan')}}">Disini</a>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                    
                </div>
              </div>
            </div>
            <!-- Sales History Starts -->
            <div class="col-md-4 col-12 pl-md-0">
              <div class="card mb-0">
                <div class="card-header pb-50">
                  <h4 class="card-title">Upload File</h4>
                </div>
                <div class="card-content">
                  <div class="card-body py-1">
                    
                    <form action="{{url('import-file')}}" method="post" class="dropzone dropzone-area" id="dpz-remove-thumb">
                      @csrf
                      <div class="dz-message">Drop Files Here To Upload</div>
                    </form>
                    
                  </div>
                  
                </div>
                {{-- <div class="card-footer border-top pb-0">
                  
                </div> --}}
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
<script src="{{asset('vendors/js/extensions/dropzone.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
<script src="{{asset('js/scripts/hotkeys.js')}}"></script>
<script src="{{asset('js/scripts/recta.js')}}"></script>
<script src="{{asset('js/scripts/numeral.js')}}"></script>
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
<script>
  $(document).ready(function(){
    

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

    
    
  });
</script>
@endsection