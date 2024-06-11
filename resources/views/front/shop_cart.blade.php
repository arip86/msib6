@extends('front.layout.app')
@section('content')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>

<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
          <div>
          
          </div>
        </div>
@php $total = 0 @endphp
@if(session('cart'))
@foreach(session('cart') as $id => $details)
@php $total += $details['harga_jual'] * $details['quantity'] @endphp
        <div class="card rounded-3 mb-4" data-id="{{ $id }}">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
              @empty($details['foto'])                
                <img
                src="{{url('admin/image/nophoto.jpg')}}"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              @else
                <img
               src="{{url('admin/image')}}/{{$details['foto']}}"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              @endempty
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">{{$details['nama']}}</p>
                <span>Rp.{{number_format($details['harga_jual'],0,',','.')}}</span>
               
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fa fa-minus"></i>
                </button>

                <input value="{{$details['quantity']}}" type="number"
                  class="form-control quantity update-cart" />

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">Rp. {{$details['harga_jual'] * $details['quantity']}}</h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <button  class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash fa-lg"></i></button>
              </div>
              
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
            
              </div>
          </div>
          
        </div>

       
        @endforeach
        @endif

        <div class="card">
        <div class="card-body p-4">
        <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-6 col-lg-6 col-xl-6">
            <button  type="button"
            class="btn btn-warning btn-block btn-lg" id="pay-button">Proceed to Pay</button>
        </div>
          <div class="col-md-3 col-lg-2 col-xl-4 offset-lg-1">
                <h5 class="mb-0">Total Rp. {{number_format($total,0,',','.')}}</h5>
              </div>
              
      </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>



<script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
    </script>
    @endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
 
    $(".update-cart").change(function (e) {
        e.preventDefault();
 
        var ele = $(this);
        var id = ele.closest('.card').data('id');
 
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: ele.val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
 
</script>
@endsection