@extends('layouts.coupon')
@section('content')
	
	<style type="text/css">
		#example_wrapper{
			padding-top: 100px;
		}	

        .ftr-bg{
            margin-top: 150px;
        }

		#example_filter{
			float: right;
		}
	</style>

	<style type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"></style>
	<style type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"></style>
	<div class="top-bar othernavbar coupon">
			<div class="container">
				
				<ul class="d-flex flex-wrap align-itmes-center justify-content-end">
					<li><a href="">Manage Coupon</a></li>
				</ul>
				
			</div>
	</div>

    @if (Session::has('cart_message'))
        <div class="alert alert-info">{{ Session::get('cart_message') }}</div>
        @php Session::forget('cart_message'); @endphp
    @endif

	<div class="socioss coupon">

		<div class="container">

			<div class="rowss">
                 <a href="{{url('/coupon/add_coupon')}}" class="btn btn-primary" style="float: right;margin-top: 35px;">Add Coupon</a>
				<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Coupon Code</th>
                <th>Coupon Name</th>
                <th>Expiration date</th>
                <th>Type</th>
                <th>Discount amount</th>
                <th>Acumulable</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($coupons)
                @foreach($coupons as $coupon)
                    @php //echo "<pre>"; print_r($coupon); die(); @endphp
                    <tr>
                        <td>{{$coupon->Id}}</td>
                        <td>{{$coupon->CodigoCupon}}</td>
                        <td>{{$coupon->NombreCupon}}</td>
                        <td>{{$coupon->FechaCaducidad}}</td>
                        <td>{{$coupon->Tipo}}</td>
                        <td>{{($coupon->Tipo=='Fixed'?'$'.number_format($coupon->Cantidad, 2) : ' '.number_format($coupon->Cantidad,2))}}</td>
                        <td>{{$coupon->Acumulable==1?'Yes':'No'}}</td>
                        <td><a href="{{url('coupon/edit/')}}/{{$coupon->Id}}">Edit</a> | <a onclick="return confirm('Estas segura?')" href="{{url('coupon/delete/')}}/{{$coupon->Id}}">Delete</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


	<script type="text/javascript">
		$(document).ready(function(){
			$(document).ready(function () {
			    $('#example').DataTable();
			});
		});
	</script>
@stop