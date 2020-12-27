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
@php
    $grant=0;
@endphp
<div class="row">
    <div class="col-12">
        
        {{-- <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p> --}}
        <div class="modal fade text-left" id="warning" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel140" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <form class="form form-vertical" method="POST" action="{{url('update-cart/kasir')}}">  
                @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Update Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon"></label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="kodecart"
                                    placeholder="Nama Barang">
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
                                  <input type="text" id="first-name-icon" class="form-control" name="jmlcart"
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

                    <button type="submit" class="btn btn-warning ml-1 btn-updatecart" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
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
                {{-- <form class="form form-vertical" method="POST" action="{{url('save-cart/kasir-save')}}">  
                    @csrf  --}}
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Bayar Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            
                            <div class="form-group hidden">
                              <label for="first-name-icon">Nominal Belanja</label>
                              <div class="position-relative has-icon-left">
                                <input type="text" id="first-name-icon" class="form-control" name="bcustomer"
                                  >
                                <div class="form-control-position">
                                  <i class="bx bx-dollar"></i>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="first-name-icon">Nominal Belanja</label>
                              <div class="position-relative has-icon-left">
                                <input type="text" id="first-name-icon" class="form-control" readonly name="btotal"
                                  >
                                <div class="form-control-position">
                                  <i class="bx bx-dollar"></i>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="first-name-icon">Nominal Bayar</label>
                              <div class="position-relative has-icon-left">
                                <input type="text" id="first-name-icon" class="form-control" name="bbayar" 
                                >
                                <div class="form-control-position">
                                  <i class="bx bx-dollar"></i>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="first-name-icon">Nominal Kembalian</label>
                              <div class="position-relative has-icon-left">
                                <input type="text" id="first-name-icon" class="form-control" readonly name="bkembalian"
                                  >
                                <div class="form-control-position">
                                  <i class="bx bx-dollar"></i>
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

                    <button type="submit" class="btn btn-warning ml-1 pay-btn" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Bayar</span>
                    </button>
                </div>
                {{-- </form> --}}
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
                  <h4 class="card-title">Kasir</h4>
                  <div class="d-flex">
                                        
                     <button type="button" class="btn btn-sm btn-success glow mr-1 btn-bayar">Bayar</button>
                    <a href="{{url('clear-cart/kasir')}}" type="button" class="btn btn-sm btn-danger glow btn-clear">Clear all</a>
                  </div>
                </div>
                <div class="card-content">
                    
                      <div class="table" style="padding : 15px">
                        <table class="table buytab" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>kode Items</th>
                                    <th>Items</th>
                                    {{-- <th>Kategori</th> --}}
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                              @foreach ($cart as $item)
                                @php
                                    $grant += $item->subtotal;
                                @endphp
                                <tr>
                                  <td>{{@$item->itemCart->id_items}}</td>  
                                  <td>{{@$item->itemCart->nama_items}}</td>  
                                  {{-- <td>{{$item->itemCart->item_kategori->nama_kategori}}</td> --}}
                                  <td>{{@$item->itemCart->item_satuan->nama_satuan}}</td>
                                  <td>{{@$item->jumlah}}</td>  
                                  <td>{{number_format(@$item->harga,2)}}</td>  
                                  <td class="text-right">{{number_format(@$item->subtotal,2)}}</td>  
                                  <td><a href="{{url('delete-cart/'.@$item->cart_id)}}" type="button" class="btn btn-xs btn-danger glow"><i class="bx bx-trash"></i></a></td>  
                                </tr>                                  
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                  <th colspan="5" style="text-align:right">Total:</th>
                              <th colspan="2" class="text-left nominaltotal">{{number_format($grant,2)}}</th>
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
                <div class="card-header pb-50">
                  <h4 class="card-title">Pilih Pelanggan</h4>
                </div>
                <div class="card-content">
                  <div class="card-body py-1">
                    
                    <form class="form form-vertical">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <label for="first-name-icon">Customer</label>
                              <div class="position-relative has-icon-left">
                                <select class="form-control" name="customer">
                                  @foreach ($customer as $item)
                                <option value="{{$item->id_customer}}">{{$item->nama_customer}}</option>      
                                  @endforeach
                                </select>
                                <div class="form-control-position">
                                  <i class="bx bx-user"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    
                  </div>
                  
                </div>
                <div class="card-footer border-top pb-0">
                  <h5>Cari Barang</h5>
                <form class="form form-vertical" action="{{url('save-cart/kasir')}}" method="post">
                  @csrf
                    <div class="form-body">
                      <div class="row">

                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-icon">Barcode</label>
                            <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="barcode" >
                              <div class="form-control-position">
                                <i class="bx bx-barcode"></i>
                              </div>
                              <div id="itemList"></div>
                          
                            </div>
                          </div>
                        </div>

                        {{-- <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-icon">Barang</label>
                            <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="item" readonly>
                              <div class="form-control-position">
                                <i class="bx bx-layer"></i>
                              </div>
                              <div id="itemList"></div>
                          
                            </div>
                          </div>
                        </div> --}}

                        {{-- <div class="col-12">
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
                        </div> --}}

                        {{-- <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-icon">Jumlah</label>
                            <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="jumlah">
                              <div class="form-control-position">
                                <i class="bx bx-layer"></i>
                              </div>
                            </div>
                          </div>
                        </div> --}}

                        {{-- <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-icon">Stok</label>
                            <div class="position-relative has-icon-left">
                              <input type="text" class="form-control" name="stok" readonly>
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
                        </div> --}}

                        <div class="col-12">
                          <button type="submit" class="btn btn-success btn-block glow mr-1 mb-1 btn-tambahkan hidden">Tambahkan</button>
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
<script src="{{asset('js/scripts/hotkeys.js')}}"></script>
<script src="{{asset('js/scripts/recta.js')}}"></script>
<script src="{{asset('js/scripts/numeral.js')}}"></script>
<script>
  $(document).ready(function(){
    var printer = new Recta('{{@$tokodata[0][0]->toko_key}}', '1811')
    $('input[name="barcode"]').focus();
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

    $('.buytab tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            buytab.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        var kode = $(this).find('td:eq(0)').html();
        var jml = $(this).find('td:eq(3)').html();
        
        
        $('#warning').modal('show');

        $('#warning input[name="kodecart"]').val(kode);
        $('#warning input[name="jmlcart"]').val(jml);

    } );

    $(document).on('shown.bs.modal','#updatemodal',function(){
      $('#updatemodal input[name="bbayar"]').focus();
    })

    $(document).on('shown.bs.modal','#warning',function(){
      $('#warning input[name="jmlcart"]').focus();
    })
    

    $(document).on('click', '.btn-bayar', function(){
      $('#updatemodal').modal('show')
      
      var customer  = $('select[name="customer"]').val();
      var total ="{{$grant}}";

      if(total == 0){
        $('#updatemodal .pay-btn').prop('disabled',true)
      }else{
        $('#updatemodal .pay-btn').prop('disabled',false)
      }
      
      $('#updatemodal input[name="bcustomer"]').val(customer);
      $('#updatemodal input[name="btotal"]').val(total);
      return false;
    });

    

    $(document).on('keyup','#updatemodal input[name="bbayar"]',function(){
      var bayar = $(this).val() ? $(this).val() : 0;
      var total =  $('#updatemodal input[name="btotal"]').val();

      $('#updatemodal input[name="bkembalian"]').val( bayar - total);

    })

    $(document).on('click','.pay-btn',function(){
     
      var cart = buytab.rows().data();
      console.log(cart)
      console.log(cart.length)

      $.each(cart, function(i,v){
        console.log(v)
      })
      

      printer.open().then(function () {
        printer.align('center')
        .bold(true)
        .mode('emphasized')
        .text('{{@$tokodata[0][0]->toko_nama}}')
        .feed(1)
        .bold(false)
        .text('{{trim(@$tokodata[0][0]->toko_alamat)}}')
        .text('{{@$tokodata[0][0]->toko_telp}}')
        .feed(1)
        .align('left')
        .text('Kasir      : {{Auth::user()->name}}')
        .text("Tanggal    : {{Carbon\Carbon::now('Asia/Jakarta')}}")
        .text('Pembayaran : Cash')
        .feed(1)
        .text("{{str_repeat('-', 32)}}")
        
        $.each(cart, function(i,v){
          var max = 32;
          var awal = v[3].length + 3;
          var tengah = v[4].length + 3;

          var akhir = v[5].length;

          var spasi = (max - ((awal + tengah)+akhir));

          console.log(spasi);
          var jeda = Array(spasi).fill(' ').join('');
          printer.text(v[1])
          
          .text("x"+ v[3] +"   @"+ v[4] +jeda+v[5])
          .feed(1)
        })
        printer.text("{{str_repeat('-', 32)}}")
        var total = $('th.nominaltotal').find('div').html()
        var bayar =  $('#updatemodal input[name="bbayar"]').val();
        var kembali =  $('#updatemodal input[name="bkembalian"]').val();
        
        var nombayar = numeral(bayar).format('0,0.00')
        var nomkembali = numeral(kembali).format('0,0.00')
        var jedatot = (32 -(5 + total.length))
        var jedabay = (32 -(5 + nombayar.length))
        var jedakem = (32 -(9 + nomkembali.length))

        var jedatot1 = Array(jedatot).fill(' ').join('');
        var jedabay1 = Array(jedabay).fill(' ').join('');
        var jedakem1 = Array(jedakem).fill(' ').join('');

        printer.text("Total"+jedatot1+""+total)
        .text("Bayar"+jedabay1+""+nombayar)
        .text("Kembalian"+jedakem1+""+nomkembali)
        .feed(1)
        .align('center')
        .text("{{@$tokodata[0][0]->toko_struk_footer}}")
        .cut()  
        .print()
      })
      
      
      save_cart();
    })
     

    function save_cart()
    {
      var customer  = $('select[name="customer"]').val();
      $.ajax({
          url:"{{ url('/save-cart/kasir-save') }}",
          method:"POST",
          data:{
            'param':customer,
            '_token': "{{ csrf_token() }}"
            },
          success:function(data){
            window.location.assign("{{url('/sales/show')}}")
          }
        });
    }
  });
</script>
@endsection