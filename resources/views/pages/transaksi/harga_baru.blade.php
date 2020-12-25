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
                    
                    <form class="form form-vertical" action="{{url('save-cart/kasir')}}" method="post">
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
      if(sisa < 0){
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
      $('#updatemodal').modal('show')
      // $('.pay-btn').trigger('click')
      var customer  = $('select[name="customer"]').val();
      

      $('#updatemodal input[name="bcustomer"]').val(customer);
      $('#updatemodal input[name="btotal"]').val(total);
      return false;
    });

    $(document).on('click', '.btn-bayar', function(){
      $('#updatemodal').modal('show')
      // $('.pay-btn').trigger('click')
      var customer  = $('select[name="customer"]').val();
      

      $('#updatemodal input[name="bcustomer"]').val(customer);
      $('#updatemodal input[name="btotal"]').val(total);
      return false;
    });

    $(document).bind('keydown', 'f1', function assets(){
      $('.btn-clear').trigger('click')
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