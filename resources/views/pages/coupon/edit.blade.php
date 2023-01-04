@extends('layouts.coupon')
@section('content')
	
	<style type="text/css">
		.ftr-bg{
            margin-top: 450px;
        }

        .add_frm{
            padding-top: 100px;
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

	<div class="socioss coupon">

		<div class="container">

			<div class="rowss">
                <a href="{{url('/coupon/index/9z$C&F)J@NcRfUjX')}}" class="btn btn-primary" style="float: right;margin-top: 35px;">Back</a>
                <form class="add_frm" name="save_frm" method="post" action="{{url('coupon/update')}}/{{$coupon->Id}}">
                  @csrf
                   <h3>Edit Coupon</h3>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Name</label>
                    <input type="text" class="form-control" value="{{$coupon->NombreCupon}}" id="" required name="coupon_name" aria-describedby="couponNameHelp" placeholder="Enter Coupon Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon Code</label>
                    <input type="text" class="form-control" value="{{$coupon->CodigoCupon}}" id="" required name="coupon_code" aria-describedby="couponCodeHelp" placeholder="Enter Coupon Code">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Expiration Date</label>
                    <input type="date" class="form-control" id="" required name="expire_date" aria-describedby="couponCodeHelp" value="<?php echo date('Y-m-d',strtotime($coupon->FechaCaducidad)) ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Type</label>
                    <select class="form-control" required name="type" aria-label="Default select example">
                      <option selected>Open this select menu</option>
                      <option {{$coupon->Tipo=='Fixed'?'selected':''}} value="Fixed">Fixed</option>
                      <option {{$coupon->Tipo=='Percentage'?'selected':''}} value="Percentage">Percentage</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Discount amount</label>
                    <input type="number" class="form-control" step="0.01" value="{{number_format($coupon->Cantidad,2)}}" id="" required name="discount_amount" aria-describedby="couponCodeHelp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Coupon User With Other</label>
                    <select class="form-control" required name="user_with" aria-label="Default select example">
                      <option selected>Open this select menu</option>
                      <option {{$coupon->Acumulable=='0'?'selected':''}} value="0">No</option>
                      <option {{$coupon->Acumulable=='1'?'selected':''}} value="1">Yes</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Save Coupon</button>
                </form>
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