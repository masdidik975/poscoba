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
                <form class="form form-vertical" method="POST" action="{{url('/save-customer')}}">  
                @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Tambah Master Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Nama Customer</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="customer"
                                    placeholder="Nama customer">
                                  <div class="form-control-position">
                                    <i class="bx bx-layer"></i>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                  <label for="first-name-icon">alamat Customer</label>
                                  <div class="position-relative has-icon-left">
                                    <input type="text" id="first-name-icon" class="form-control" name="alamat"
                                      placeholder="Alamat">
                                    <div class="form-control-position">
                                      <i class="bx bx-home"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group">
                                  <label for="first-name-icon">Telfon Customer</label>
                                  <div class="position-relative has-icon-left">
                                    <input type="text" id="first-name-icon" class="form-control" name="telfon"
                                      placeholder="Telfon">
                                    <div class="form-control-position">
                                      <i class="bx bx-phone"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group">
                                  <label for="first-name-icon">Email</label>
                                  <div class="position-relative has-icon-left">
                                    <input type="text" id="first-name-icon" class="form-control" name="email"
                                      placeholder="email">
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
                <form class="form form-vertical" method="POST" action="{{url('/update-customer')}}">  
                    @csrf 
                <div class="modal-header bg-warning">
                    <h5 class="modal-title white" id="myModalLabel140">Update Master Customer</h5>
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
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <label for="first-name-icon">Nama Customer</label>
                              <div class="position-relative has-icon-left">
                                <input type="text" id="first-name-icon" class="form-control" name="customer"
                                  placeholder="Nama customer">
                                <div class="form-control-position">
                                  <i class="bx bx-layer"></i>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">alamat Customer</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="alamat"
                                    placeholder="Alamat">
                                  <div class="form-control-position">
                                    <i class="bx bx-home"></i>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Telfon Customer</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="telfon"
                                    placeholder="Telfon">
                                  <div class="form-control-position">
                                    <i class="bx bx-phone"></i>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12">
                              <div class="form-group">
                                <label for="first-name-icon">Email</label>
                                <div class="position-relative has-icon-left">
                                  <input type="text" id="first-name-icon" class="form-control" name="email"
                                    placeholder="email">
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
                    <h4 class="card-title">Master Customer</h4>
                    <div class="heading-elements">
                        <button type="button" class="btn btn-icon rounded-circle btn-warning mr-1 mb-1" data-toggle="modal" data-target="#warning"><i
                            class="bx bx-list-plus"></i></button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        {{-- <p class="card-text">DataTables has most features enabled by default, so all you need to do to
                            use it with your own tables is to call the construction function: $().DataTable();.</p> --}}
                        
                            
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama </th>
                                        <th>Alamat</th>
                                        <th>phone</th>
                                        <th>Email</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->nama_customer}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>{{$item->telfon}}</td>
                                            <td>{{$item->email}}</td>
                                            <td><button type="button" class="btn btn-icon rounded-circle btn-success mr-1 mb-1 btn-edit" data-id="{{$item->id_customer}}" data-customer="{{$item->nama_customer}}" data-alamat="{{$item->alamat}}" data-phone="{{$item->telfon}}" data-email="{{$item->email}}"><i
                                                class="bx bx-pen"></i></button><a href="{{url('/hapus-customer/'.$item->id_customer)}}" type="button" class="btn btn-icon rounded-circle btn-danger mr-1 mb-1" ><i
                                                    class="bx bx-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>phone</th>
                                        <th>Email</th>
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

    $(document).on('click','.btn-edit',function(){
        var customer      = $(this).data('customer');
        var alamat      = $(this).data('alamat');
        var phone      = $(this).data('phone');
        var email     = $(this).data('email');
        var id          = $(this).data('id');

        $('#updatemodal input[name="id"]').val(id)
        $('#updatemodal input[name="customer"]').val(customer)
        $('#updatemodal input[name="telfon"]').val(phone)
        $('#updatemodal input[name="email"]').val(email)
        $('#updatemodal input[name="alamat"]').val(alamat)
        $('#updatemodal').modal('show');
    })
</script>
@endsection