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
<div class="row">
    <div class="col-12">
        
        {{-- <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p> --}}
        <div class="modal fade text-left" id="warning" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel140" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <form class="form form-vertical" method="POST" action="{{url('/save-items')}}">  
                @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Tambah Master Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Nama Barang</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="barang"
                                    placeholder="Nama Barang">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                  <label for="password-icon">Satuan Jual</label>  
                                  <div class="position-relative has-icon-left">
                                      <select class="form-control" id="basicSelect" name="satuan">
                                          @foreach ($satuan as $item)
                                          <option value="{{$item->id_satuan}}">{{$item->nama_satuan}}</option>    
                                          @endforeach
                                          
                                          
                                      </select>
                                      <div class="form-control-position">
                                          <i class="bx bx-purchase-tag"></i>
                                      </div>
                                  </div>    
                                </div>
                              </div>
                            
                            
                            <div class="col-12">
                              <div class="form-group">
                                <label for="password-icon">Kategori</label>  
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" id="basicSelect" name="kategori">
                                        @foreach ($kategori as $item)
                                        <option value="{{$item->id_kategori}}">{{$item->nama_kategori}}</option>    
                                        @endforeach
                                        
                                        
                                    </select>
                                    <div class="form-control-position">
                                        <i class="bx bx-list-plus"></i>
                                    </div>
                                </div>    
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="submit" class="btn btn-warning ml-1" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade text-left" id="updatemodal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel140" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <form class="form form-vertical" method="POST" action="{{url('/update-items')}}">  
                    @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Update Master Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group hidden">
                                <label for="first-name-icon">Nama Barang</label>
                                <div class="position-relative has-icon-left">
                                  <input type="hidden" id="first-name-icon" class="form-control" name="id"
                                    placeholder="Nama Barang">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                </div>
                              </div> 
                            <div class="form-group">
                              <label for="first-name-icon">Nama Barang</label>
                              <div class="position-relative has-icon-left">
                                <input type="text" id="first-name-icon" class="form-control" name="barang"
                                  placeholder="Nama Barang">
                                <div class="form-control-position">
                                  <i class="bx bx-layer"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                <label for="password-icon">Satuan Jual</label>  
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" id="basicSelect" name="satuan">
                                        @foreach ($satuan as $item)
                                        <option value="{{$item->id_satuan}}">{{$item->nama_satuan}}</option>    
                                        @endforeach
                                        
                                        
                                    </select>
                                    <div class="form-control-position">
                                        <i class="bx bx-purchase-tag"></i>
                                    </div>
                                </div>    
                              </div>
                            </div>
                          
                          
                          <div class="col-12">
                            <div class="form-group">
                              <label for="password-icon">Kategori</label>  
                              <div class="position-relative has-icon-left">
                                  <select class="form-control" id="basicSelect" name="kategori">
                                      @foreach ($kategori as $item)
                                      <option value="{{$item->id_kategori}}">{{$item->nama_kategori}}</option>    
                                      @endforeach
                                      
                                      
                                  </select>
                                  <div class="form-control-position">
                                      <i class="bx bx-list-plus"></i>
                                  </div>
                              </div>    
                            </div>
                          </div>
                          
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="submit" class="btn btn-warning ml-1" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
                </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Zero configuration table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Master Items {{ $modul == "show" ? "All" : $modul}}</h4>
                    <div class="heading-elements">
                        <button type="button" class="btn btn-icon rounded-circle btn-warning mr-1 mb-1" data-toggle="modal" data-target="#warning"><i
                            class="bx bx-list-plus"></i></button>
                            <a href="{{url('/item-import')}}" type="button" class="btn btn-success glow mr-1 mb-1">Import Excel</a>    
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        {{-- <p class="card-text">DataTables has most features enabled by default, so all you need to do to
                            use it with your own tables is to call the construction function: $().DataTable();.</p> --}}
                        @foreach ($kategori as $item)
                        <a href="{{url('/items/'.$item->nama_kategori)}}" type="button" class="btn {{ $modul == $item->nama_kategori ? 'btn-warning' :'btn-dark' }} glow mr-1 mb-1" name="{{$item->nama_kategori}}">{{$item->nama_kategori}}</a>
                        @endforeach
                            
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Items</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th>Harga Jual</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->nama_items}}</td>
                                            <td><div class="chip chip-success mr-1">
                                                <div class="chip-body">
                                                  <div class="avatar">
                                                    <i class="bx bx-box"></i>
                                                  </div>
                                                  <span class="chip-text">{{$item->item_satuan->nama_satuan}}</span>
                                                </div>
                                              </div></td>
                                            <td><div class="chip chip-success mr-1">
                                                <div class="chip-body">
                                                  <div class="avatar">
                                                    <i class="bx bx-list-ol"></i>
                                                  </div>
                                                  <span class="chip-text">{{$item->item_kategori->nama_kategori}}</span>
                                                </div>
                                              </div></td>
                                            <td>{{number_format($item->harga_items,2)}}</td>
                                            <td><button type="button" class="btn btn-icon rounded-circle btn-success mr-1 mb-1 btn-edit" data-barang="{{$item->nama_items}}" data-kategori="{{$item->item_kategori->id_kategori}}" data-satuan="{{$item->item_satuan->id_satuan}}" data-harga="{{$item->harga_items}}" data-id="{{$item->id_items}}"><i
                                                class="bx bx-pen"></i></button><a href="{{url('/hapus-items/'.$item->id_items)}}" type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1" ><i
                                                    class="bx bx-trash"></i></a><button type="button" class="btn btn-icon rounded-circle btn-warning mr-1 mb-1 btn-barcode" data-id="{{$item->id_items}}" data-kategori="{{$item->kategori_items}}" data-satuan="{{$item->satuan_items}}"><i
                                                      class="bx bx-barcode"></i></button><a href="{{url('/price-items/'.$item->id_items)}}" type="button" class="btn btn-icon rounded-circle btn-info mr-1 mb-1" ><i
                                                        class="bx bx-money"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Items</th>
                                        <th>Satuan</th>
                                        <th>Kategori</th>
                                        <th>Harga Jual</th>
                                        <th>Menu</th>
                                    </tr>
                                </tfoot>
                            </table>
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
<script src="{{asset('js/scripts/recta.js')}}"></script>
<script>
  var printer = new Recta('{{@$tokodata[0][0]->toko_key}}', '1811')
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

    $(document).on('click','.btn-edit',function(){
        var barang      = $(this).data('barang');
        var harga       = $(this).data('harga');
        var kategori    = $(this).data('kategori');
        var satuan      = $(this).data('satuan');
        var id          = $(this).data('id');

        $('#updatemodal input[name="id"]').val(id)
        $('#updatemodal input[name="barang"]').val(barang)
        $('#updatemodal select[name="kategori"]').val(kategori);
        $('#updatemodal select[name="satuan"]').val(satuan);
        
        $('#updatemodal').modal('show');
    })

    $(document).on('click','.btn-barcode',function(){
        var kategori    = $(this).data('kategori');
        var satuan      = $(this).data('satuan');
        var id          = $(this).data('id');
        var barcode     = id.toString() + kategori.toString() + satuan.toString();

        printer.open().then(function () {
          printer.align('center')
          .barcode('CODE39', barcode, 100)
          .cut()  
          .print()
        })

        
    })
</script>
@endsection