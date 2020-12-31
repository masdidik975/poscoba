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
    <div class="col-xl-12 col-12 dashboard-order-summary">
        <div class="card">
          <div class="row">
            <!-- Order Summary Starts -->
            <div class="col-md-12 col-12 order-summary  pr-md-0">
              <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Download Report Stok By Periode</h4>
                  <div class="d-flex">
                    
                     {{-- <button type="button" class="btn btn-sm btn-success glow mr-1 btn-bayar">(f2) Bayar</button>
                    <a href="{{url('clear-cart/kasir')}}" type="button" class="btn btn-sm btn-danger glow btn-clear">(f1) Clear all</a> --}}
                  </div>
                </div>
                <div class="card-content">
                  <form class="form mr-3 ml-3" action="{{url('generate-stok')}}" method="POST">
                    @csrf
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <div class="form-group">
                            <label for="first-name-vertical">Dari</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="dari" required data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="__/__/____"
                              placeholder="Periode dari">
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <div class="form-group">
                            <label for="first-name-vertical">Sampai</label>
                            <input type="text" id="first-name-vertical" class="form-control" name="sampai" required data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="__/__/____"
                              placeholder="Periode Sampai">
                          </div>
                        </div>
                        <div class="col-md-4 col-12">
                          <button type="submit" class="btn btn-success glow mt-2">Generate</button>
                        </div>
                      </div>
                    </div>
                  </form>
                    
                </div>
              </div>
            </div>
            <!-- Sales History Starts -->
            
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
<script src="{{asset('js/scripts/hotkeys.js')}}"></script>
<script src="{{asset('js/scripts/recta.js')}}"></script>
<script src="{{asset('js/scripts/numeral.js')}}"></script>
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
<script src="{{asset('js/scripts/inputmask.js')}}"></script>
<script>
  $(document).ready(function(){
    $("input[name='dari']").inputmask();
    $("input[name='sampai']").inputmask();
    var mfom = $('div.dashboard-order-summary');
    $(document).on('submit', 'form', function() {
      $(mfom).block({
        message:'<span class="semibold"> Silahkan Tunggu...</span>',
        overlayCSS:{backgroundColor:"#fff",opacity:.8,cursor:"wait"},
        css:{border:0,
              padding:0,
              backgroundColor:"transparent"
              }
      })
        $('button').attr('disabled', 'disabled');
    });

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