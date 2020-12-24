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
                <form class="form form-vertical" method="POST" action="#">  
                @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Tambah Master Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Nama Kategori</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="kategori"
                                    placeholder="Nama Barang">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
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
                    </button>2
                </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade text-left" id="updatemodal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel140" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <form class="form form-vertical" method="POST" action="{{url('save-cart/opname-save')}}">  
                    @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Simpan Opname</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            <h4>Apakah Anda Yakin Opname</h4>    
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
                    <span class="d-none d-sm-block">Opname</span>
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
    <div class="col-xl-12 col-12 dashboard-order-summary">
        <div class="card">
          <div class="row">
            <!-- Order Summary Starts -->
            <div class="col-md-8 col-12 order-summary border-right pr-md-0">
              <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Form Opname</h4>
                  <div class="d-flex">
                    
                     <button type="button" class="btn btn-sm btn-success glow mr-1 btn-bayar" data-toggle="modal" data-target="#updatemodal">(f2) Simpan</button>
                    <a href="{{url('clear-cart/opname')}}" type="button" class="btn btn-sm btn-danger glow btn-clear">Clear all</a>
                  </div>
                </div>
                <div class="card-content">
                    
                      <div class="table" style="padding : 15px">
                        <table class="table buytab" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>kode Items</th>
                                    <th>Items</th>
                                    
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php
                                  $grant=0;
                              @endphp
                              @foreach ($cart as $item)
                                @php
                                    $grant += $item->subtotal;
                                @endphp
                                <tr>
                                  <td>{{$item->itemCart->id_items}}</td>  
                                  <td>{{$item->itemCart->nama_items}}</td>  
                                  
                                  <td>{{$item->itemCart->item_satuan->nama_satuan}}</td>
                                  <td>{{$item->jumlah}}</td>  
                                  <td>{{number_format($item->harga,2)}}</td>  
                                  <td class="text-right">{{number_format($item->subtotal,2)}}</td>  
                                  <td><a href="{{url('delete-cart/'.$item->cart_id)}}" type="button" class="btn btn-xs btn-danger glow"><i class="bx bx-trash"></i></a></td>  
                                </tr>                                  
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                  <th colspan="5" style="text-align:right">Total:</th>
                              <th colspan="2" class="text-left">{{number_format($grant,2)}}</th>
                              </tr>
                          </tfoot>
                        </table>
                    </div>
                    
                </div>
              </div>
            </div>
            <!-- Sales History Starts -->
            <div class="col-md-4 col-12 pl-md-0">
              <div class="card mb-0">
                
                <div class="card-footer border-top pb-0">
                  <h5>Cari Barang</h5>
                <form class="form form-vertical" action="{{url('save-cart/opname')}}" method="post">
                  @csrf
                    <div class="form-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-icon">Barang</label>
                            <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="item">
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
                              <input type="text" class="form-control" name="kode" readonly>
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
                              <input type="text" class="form-control" name="satuan" readonly>
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
                              <input type="text" class="form-control" name="kategori" readonly>
                              <div class="form-control-position">
                                <i class="bx bx-layer"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-icon">Jumlah</label>
                            <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="jumlah">
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
                              <input type="text" class="form-control" name="harga" readonly>
                              <div class="form-control-position">
                                <i class="bx bx-dollar"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12">
                          <button type="submit" class="btn btn-success btn-block glow mr-1 mb-1 btn-tambahkan">Tambahkan</button>
                        </div>
                        

                      </div>
                    </div>
                  </form>
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
<script src="https://cdn.jsdelivr.net/npm/jquery.hotkeys@0.1.0/jquery.hotkeys.js"></script>
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

    $(document).on('keyup','input[name="item"]',function(){
      var param = $(this).val();
      if(param != ""){
        $.ajax({
          url:"{{ url('find_master_barang') }}",
          method:"POST",
          data:{
            'param':param,
            '_token': "{{ csrf_token() }}"
            },
          success:function(data){
           $('div#itemList').fadeIn();  
                    $('div#itemList').html(data);
          }
         });
    
      }
    })

    $(document).on('click', 'li.dd', function(){  
        $('input[name="item"]').val($(this).text());  
        var satuan = $(this).data('satuan')
        var kategori = $(this).data('kategori')
        var kode = $(this).data('kode')
        var harga = $(this).data('harga')
        var stok = $(this).data('stok')

        $('input[name="satuan"]').val(satuan);  
        $('input[name="kategori"]').val(kategori);  
        $('input[name="kode"]').val(kode);
        $('input[name="harga"]').val(harga);    
        $('input[name="stok"]').val(stok);    
        $('div#itemList').fadeOut();  

        console.log($(this).text())
    });   


    $(document).on('keyup','input[name="jumlah"]',function(){
      var param = ($(this).val() == "")? 0 : $(this).val() ;
      var stok  = $('input[name="stok"]').val();
      var sisa =stok - param; 
      if(sisa <= 0){
        toastr.error("STOK HABIS");
        $('.btn-tambahkan').addClass('hidden');
      }else{
        $('.btn-tambahkan').removeClass('hidden');
      }
      
      // alert(sisa)
    })

    $(document).on('click','button.save-cart',function(){
          var customer  = $('select[name="customer"]').val();
              

          // if((stok - jumlah) > 0 ){
          //   $.ajax({
          //     url:"{{ url('/save-cart/issued-save') }}",
          //     method:"POST",
          //     data:{
          //       'param':customer,
          //       '_token': "{{ csrf_token() }}"
          //       },
          //     success:function(data){
          //       window.location.assign("{{url('/sales/show')}}")
          //     }
          //   });
          // }
          

          // alert(stok - jumlah)
    })
    
    $(document).bind('keydown', 'f2', function assets(){
      $('.btn-bayar').trigger('click')
      var customer  = $('select[name="customer"]').val();
      

      $('#updatemodal input[name="bcustomer"]').val(customer);
      $('#updatemodal input[name="btotal"]').val(total);
      return false;
    });

    

    $(document).on('keyup','#updatemodal input[name="bbayar"]',function(){
      var bayar = $(this).val() ? $(this).val() : 0;
      var total =  $('#updatemodal input[name="btotal"]').val();

      $('#updatemodal input[name="bkembalian"]').val( bayar - total);

    })
  });
</script>
@endsection