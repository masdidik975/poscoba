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
            <div class="col-md-8 col-12 order-summary border-right pr-md-0">
              <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Historical Pembelian Items</h4>
                  <div class="d-flex">
                    
                     {{-- <button type="button" class="btn btn-sm btn-success glow mr-1 btn-bayar">(f2) Bayar</button>
                    <a href="{{url('clear-cart/kasir')}}" type="button" class="btn btn-sm btn-danger glow btn-clear">(f1) Clear all</a> --}}
                  </div>
                </div>
                <div class="card-content">
                    
                      <div class="table" style="padding : 15px">
                        <table class="table buytab" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>kode Items</th>
                                    <th>Items</th>
                                    <th>Kategori</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Pembelian Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                
                              {{-- @foreach ($cart as $item) --}}
                                @foreach ($cart->receive_items as $p)
                                <tr>
                                  <td>{{$cart->id_items}}</td>  
                                  <td>{{$cart->nama_items}}</td> 
                                  <td>{{$cart->item_kategori->nama_kategori}}</td>
                                  <td>{{$cart->item_satuan->nama_satuan}}</td>
                                  <td>{{number_format($p->receive_harga,2)}}</td>  
                                  <td>{{$p->created_at}}</td>   
                                  
                                </tr>                                      
                                @endforeach
                                
                              {{-- @endforeach --}}
                            </tbody>
                            
                        </table>
                    </div>
                    
                </div>
              </div>
            </div>
            <!-- Sales History Starts -->
            <div class="col-md-4 col-12 pl-md-0">
              <div class="card mb-0">
                <div class="card-header pb-50">
                  <h4 class="card-title">Setting Harga Jual</h4>
                </div>
                <div class="card-content">
                  <div class="card-body py-1">
                    
                    <form class="form form-vertical" action="{{url('update-harga-items')}}" method="post">
                      @csrf
                        <div class="form-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Barang</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" class="form-control" name="item" readonly value="{{$cart->nama_items}}">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                  <div id="itemList"></div>
                              
                                </div>
                              </div>
                            </div>
    
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Kode</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" class="form-control" name="kode" readonly value="{{$cart->id_items}}">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
    
                            <div class="col-6">
                              <div class="form-group">
                                <label for="first-name-icon">Satuan</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" class="form-control" name="satuan" readonly value="{{$cart->item_satuan->nama_satuan}}">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
    
                            <div class="col-6">
                              <div class="form-group">
                                <label for="first-name-icon">Kategori</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" class="form-control" name="kategori" readonly value="{{$cart->item_kategori->nama_kategori}}">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
    
                            
    
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Harga</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" class="form-control" name="harga" >
                                  <div class="form-control-position">
                                    <i class="bx bx-dollar"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
    
                            <div class="col-12">
                              <button type="submit" class="btn btn-success btn-block glow mr-1 mb-1 btn-tambahkan">Update</button>
                            </div>
                            
    
                          </div>
                        </div>
                      </form>  
                    
                  </div>
                  
                </div>
                <div class="card-footer border-top pb-0">
                  
                </div>
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
<script src="{{asset('js/scripts/hotkeys.js')}}"></script>
<script src="{{asset('js/scripts/recta.js')}}"></script>
<script src="{{asset('js/scripts/numeral.js')}}"></script>
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

    
    var buytab = $('.buytab').DataTable( {
        scrollX:true,
        "pageLength": 10,
        "lengthChange": false,
        "searching":false
    });

  });
</script>
@endsection