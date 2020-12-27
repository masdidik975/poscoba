@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Invoice')
{{-- styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
<style>
  .rubber {
  box-shadow: 0 0 0 3px red, 0 0 0 2px red inset;  
  border: 2px solid transparent;
  border-radius: 4px;
  display: inline-block;
  padding: 5px 2px;
  line-height: 22px;
  color: red;
  font-size: 24px;
  font-family: 'Black Ops One', cursive;
  text-transform: uppercase;
  text-align: center;
  opacity: 0.4;
  width: 155px;
  transform: rotate(-5deg);
}

</style>
@endsection
@section('content')
    <!-- app invoice View Page -->
<section class="invoice-view-wrapper">
  <div class="row">
    <!-- invoice view page -->
    <div class="col-xl-9 col-md-8 col-12">
      <div class="card invoice-print-area">
        <div class="card-content">
          <div class="card-body pb-0 mx-25">
            <!-- header section -->
            <div class="row">
              <div class="col-xl-4 col-md-12">
                <span class="invoice-number mr-50">Opname#</span>
                <span>{{$opname->id_opname.$opname->user_opname}}</span>
              </div>
              <div class="col-xl-8 col-md-12">
                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                  <div class="mr-3">
                    <small class="text-muted">Tanggal Opname:</small>
                    <span>{{$opname->tanggal_opname}}</span>
                  </div>
                  <div>
                    <small class="text-muted">Jam:</small>
                    <span>{{$opname->jam_opname}}</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- logo and title -->
            <div class="row my-3">
              <div class="col-6">
                <h4 class="text-primary">Stok Opname</h4>
                <span>Opname Toko</span>
              </div>
              <div class="col-6 d-flex justify-content-end">
                {{-- <img src="{{asset('images/pages/pixinvent-logo.png')}}" alt="logo" height="46" width="164"> --}}
              </div>
            </div>
            <hr>
            <!-- invoice address and contact -->
            <div class="row invoice-info">
              <div class="col-6 mt-1">
                <h6 class="invoice-from">User Opname</h6>
                <div class="mb-1">
                  <span>{{Auth::user()->name}}</span>
                </div>
                <div class="mb-1">
                  <span>{{Auth::user()->email}}</span>
                </div>
                
              </div>
              
            </div>
            <hr>
          </div>
          <!-- product details table-->
          <div class="invoice-product-details table-responsive mx-md-25">
            <table class="table table-borderless mb-0">
              <thead>
                <tr class="border-0">
                  <th scope="col">Kode</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Status Opname</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach ($opname->detail_opname as $item)
                    <tr>
                      <td>{{@$item->item_id}}</td>
                      <td>{{@$item->item_opname->nama_items}}</td>
                      <td>{{@$item->opname_qty}}</td>
                      <td>{{@$item->opname_modul}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- invoice subtotal -->
          <div class="card-body pt-0 mx-25">
            <hr>
            <div class="row">
              <div class="col-4 col-sm-6 mt-75">
                {{-- <p>Thanks for your business.</p> --}}
                {{-- <div class="rubber">
                  LUNAS
                </div> --}}
              </div>
              <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                <div class="invoice-subtotal">
                  {{-- <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Grand Total</span>
                    <span class="invoice-value">{{number_format($grand, 2)}}</span>
                  </div> --}}
                  {{-- <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Discount</span>
                    <span class="invoice-value">- $ 09.60</span>
                  </div>
                  <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Tax</span>
                    <span class="invoice-value">21%</span>
                  </div>
                  <hr>
                  <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Invoice Total</span>
                    <span class="invoice-value">$ 66.40</span>
                  </div>
                  <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Paid to date</span>
                    <span class="invoice-value">- $ 00.00</span>
                  </div>
                  <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Balance (USD)</span>
                    <span class="invoice-value">$ 10,953</span>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- invoice action  -->
    <div class="col-xl-3 col-md-4 col-12">
      <div class="card invoice-action-wrapper shadow-none border">
        <div class="card-body">
          {{-- <div class="invoice-action-btn">
            <button class="btn btn-primary btn-block invoice-send-btn">
              <i class="bx bx-send"></i>
              <span>Send Invoice</span>
            </button>
          </div> --}}
          <div class="invoice-action-btn">
            <button class="btn btn-light-primary btn-block invoice-print">
              <span>Print</span>
            </button>
          </div>
          <div class="invoice-action-btn">
            {{-- <a href="{{asset('app-invoice-edit')}}" class="btn btn-light-primary btn-block">
              <span>Edit Faktur</span>
            </a> --}}
          </div>
          {{-- <div class="invoice-action-btn">
            <button class="btn btn-success btn-block">
              <i class='bx bx-dollar'></i>
              <span>Add Payment</span>
            </button>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
@endsection