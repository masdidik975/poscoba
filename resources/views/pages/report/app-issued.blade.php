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
                <span class="invoice-number mr-50">Invoice#</span>
                <span>{{$ih->id_issued.$ih->customer_id.$ih->jenis_id}}</span>
              </div>
              <div class="col-xl-8 col-md-12">
                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                  <div class="mr-3">
                    <small class="text-muted">Tanggal Penjualan:</small>
                    <span>{{$ih->tanggal_issued}}</span>
                  </div>
                  <div>
                    <small class="text-muted">Jam:</small>
                    <span>{{$ih->jam_issued}}</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- logo and title -->
            <div class="row my-3">
              <div class="col-6">
                <h4 class="text-primary">Invoice</h4>
                <span>{{$ih->jenis_issued->nama_jenis}}</span>
              </div>
              <div class="col-6 d-flex justify-content-end">
                {{-- <img src="{{asset('images/pages/pixinvent-logo.png')}}" alt="logo" height="46" width="164"> --}}
              </div>
            </div>
            <hr>
            <!-- invoice address and contact -->
            <div class="row invoice-info">
              <div class="col-6 mt-1">
                <h6 class="invoice-from">Toko</h6>
                <div class="mb-1">
                  <span>{{@$tokodata[0][0]->toko_nama}}</span>
                </div>
                <div class="mb-1">
                  <span>{{@$tokodata[0][0]->toko_alamat}}</span>
                </div>
                <div class="mb-1">
                  <span>{{@$tokodata[0][0]->toko_telp}}</span>
                </div>
                
              </div>
              <div class="col-6 mt-1">
                <h6 class="invoice-to">Customer</h6>
                <div class="mb-1">
                  <span>{{@$ih->customer->nama_customer}}</span>
                </div>
                <div class="mb-1">
                  <span>{{@$ih->customer->alamat}}</span>
                </div>
                <div class="mb-1">
                  <span>{{@$ih->customer->email}}</span>
                </div>
                
                <div class="mb-1">
                  <span>{{@$ih->customer->telfon}}</span>
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
                  <th scope="col">Satuan</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Harga Jual</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col" class="text-right">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $grand = 0;
                @endphp
                @foreach ($idet as $item)
                    @php
                        $grand += $item->issued_qty * @$item->issued_harga;
                    @endphp
                    <tr>
                      <td>{{@$item->detail_item->id_items.@$item->detail_item->kategori_items.@$item->detail_item->satuan_items}}</td>
                      <td>{{@$item->detail_item->nama_items}}</td>
                      <td>{{@$item->detail_item->item_satuan->nama_satuan}}</td>
                      <td>{{@$item->detail_item->item_kategori->nama_kategori}}</td>
                      <td>{{number_format(@$item->issued_harga,2)}}</td>
                      <td>{{@$item->issued_qty}}</td>
                      <td class="text-right">{{number_format((@$item->issued_harga * @$item->issued_qty),2)}}</td>
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
                <div class="rubber">
                  {{@$ih->pembayaran}}
                </div>
              </div>
              <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                <div class="invoice-subtotal">
                  <div class="invoice-calc d-flex justify-content-between">
                    <span class="invoice-title">Grand Total</span>
                    <span class="invoice-value">{{number_format($grand, 2)}}</span>
                  </div>
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