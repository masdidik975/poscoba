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
                <form class="form form-vertical" method="POST" action="#">  
                    @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Update Master Kategori</h5>
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
                    <h4 class="card-title">Transaksi Penjualan</h4>
                    <div class="heading-elements">
                        <a href="{{url('/buat-sales/baru')}}" target="_blank" type="button" class="btn btn-icon rounded-circle btn-warning mr-1 mb-1"><i
                            class="bx bx-list-plus"></i></a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="{{url('sales/filter')}}" method="GET">
                            @csrf
                            <div class="form-body">
                              <div class="row">
                                <div class="col-md-3 col-12">
                                  <div class="form-group">
                                    <label for="first-name-vertical">Dari</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="dari" required data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="__/__/____"
                                      placeholder="Periode dari">
                                  </div>
                                </div>
                                <div class="col-md-3 col-12">
                                  <div class="form-group">
                                    <label for="first-name-vertical">Sampai</label>
                                    <input type="text" id="first-name-vertical" class="form-control" name="sampai" required data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="__/__/____"
                                      placeholder="Periode Sampai">
                                  </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="first-name-icon">Pembayaran</label>
                                        <div class="position-relative has-icon-left">
                                        <select class="form-control" name="pembayaran">
                                            <option value="All">All</option>      
                                            <option value="Cash">Cash</option>      
                                            <option value="Kredit">Kredit</option>      
                                        </select>
                                        <div class="form-control-position">
                                            <i class="bx bxs-wallet-alt"></i>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                  <button type="submit" class="btn btn-success glow mt-2">Cari</button>
                                </div>
                              </div>
                            </div>
                          </form>
                          <hr>
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Customer</th>
                                        <th>Jenis</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $gt=[];
                                    @endphp
                                    @foreach ($issued as $item)
                                        @php
                                            $total=0;
                                        @endphp
                                        @foreach ($item->detail_issued as $detail)
                                            @php
                                                $total += $detail->issued_qty * $detail->issued_harga;
                                            @endphp
                                        @endforeach
                                        @php
                                        array_push($gt, $total);    
                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->tanggal_issued}}</td>
                                            <td>{{$item->jam_issued}}</td>
                                            <td>{{@$item->customer->nama_customer}}</td>
                                            <td>{{$item->jenis_issued->nama_jenis}}</td>
                                            <td>{{number_format($gt[$loop->iteration - 1], 2)}}</td>
                                            <td>{{$item->pembayaran}}</td>
                                            <td><a href="{{url('detail-issued/'.$item->id_issued)}}" type="button" class="btn btn-icon rounded-circle btn-info mr-1 mb-1" ><i
                                                class="bx 
                                                bx-file"></i></a><a href="{{url('delete-sales/'.$item->id_issued)}}" type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1" ><i
                                                    class="bx bx-trash"></i></a>
                                                @if ($item->pembayaran == "Kredit")
                                                <a href="{{url('lunasi-sales/'.$item->id_issued)}}" type="button" class="btn btn-icon rounded-circle btn-info mr-1 mb-1" ><i
                                                    class="bx bxs-dollar-circle"></i></a>
                                                @endif
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Customer</th>
                                        <th>Jenis</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
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
<script src="{{asset('js/scripts/inputmask.js')}}"></script>
<script>
    $("input[name='dari']").inputmask();
    $("input[name='sampai']").inputmask();
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