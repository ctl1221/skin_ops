@extends('master')

@section ('heading')

	Please Confirm Transaction
	
@endsection

@section('contents')

<div class="container mb-5">

	<div class="card">
		<div class="card-body">
			
				<div class="row">
					<div class="form-group col">
						<label for="name">Name:</label>
						<input type="text" class="form-control" 
						id="name" name="name" value="{{ $sales_order->client->display_name() }}" disabled>
					</div>
				</div>

				<div class="row">
						<div class="form-group col">
						<label for="date">Date:</label>
						<input type="date" class="form-control" 
						id="date" name="date" value="{{ $sales_order->date }}" disabled="">
					</div>

					<div class="form-group col">
						<label for="draft_no">Draft Number:</label>
						<input type="text" class="form-control" id="so_no" name="draft_no" disabled>
					</div>
				</div>

				<div class="row mb-3">
					<div class="form-group col">
						<label for="branch">Branch:</label>
						<input type="text" class="form-control" id="branch" name="branch" value="" disabled>
					</div>

					<div class="form-group col">
						<label for="pricelist">Pricelist:</label>
						<input type="text" class="form-control" id="pricelist" name="pricelist" value="" disabled>
					</div>
				</div>

		</div>
	</div>

	<div class="table-responsive">
      	<table class="table table-bordered table-sm mb-4">

        <thead>

        	<tr>
	            <th colspan="6" class="text-center bg-secondary text-white">
	              <h5 class="mt-1 mb-1">Item Details</h5>
	            </th>
          	</tr>

          	<tr>
	            <th>Type</th>
	            <th>Item</th>
	            <th>Price</th>
	            <th>Sold By</th>
	            <th>Treated By</th>
	            <th>Assisted By</th>
          	</tr>

        </thead>

        <tbody>

        	@foreach($sales_order->sales_order_lines as $x)
        	<tr>
        		<td>{{ substr($x->sellable_type, 4)}}</td>
        		<td>{{ $x->sellable->name}}</td>
        		<td>{{ $x->price }}</td>
        		<td>{{ $x->seller ? $x->seller->display_name() : '---' }}</td>
        		<td>{{ $x->treater ? $x->treater->display_name() : '---' }}</td>
        		<td>{{ $x->assistant ? $x->assistant->display_name() : '---' }}</td>
        	</tr>
        	@endforeach

        </tbody>

      	</table>
    </div>   

    <div class="table-responsive">
      	<table class="table table-bordered table-sm mb-4">

        <thead>

        	<tr>
	            <th colspan="3" class="text-center bg-secondary text-white">
	              <h5 class="mt-1 mb-1">Discounts and Freebies</h5>
	            </th>
          	</tr>

          	<tr>
	            <th>Type</th>
	            <th>Amount</th>
	            <th>Reference</th>
          	</tr>

        </thead>

        <tbody>

        	@foreach($sales_order->payments as $x)
        		@if($x->payment_type->is_subtractable)
	        	<tr>
	        		<td>{{ $x->payment_type->name }}</td>
	        		<td>{{ $x->amount }}</td>
	        		<td>{{ $x->reference }}</td>
	        	</tr>
	        	@endif
        	@endforeach

        </tbody>

      	</table>
    </div>   

    <div class="table-responsive">
      	<table class="table table-bordered table-sm mb-4">

        <thead>

        	<tr>
	            <th colspan="3" class="text-center bg-secondary text-white">
	              <h5 class="mt-1 mb-1">Payment Modes</h5>
	            </th>
          	</tr>

          	<tr>
	            <th>Type</th>
	            <th>Amount</th>
	            <th>Reference</th>
          	</tr>

        </thead>

        <tbody>

        	@foreach($sales_order->payments as $x)
        		@if($x->payment_type->is_direct || $x->payment_type->is_external)
	        	<tr>
	        		<td>{{ $x->payment_type->name }}</td>
	        		<td>{{ $x->amount }}</td>
	        		<td>{{ $x->reference }}</td>
	        	</tr>
	        	@endif
        	@endforeach

        </tbody>

      	</table>
    </div> 

     <div class="table-responsive">
      	<table class="table table-bordered table-sm mb-4">

        <thead>

        	<tr>
	            <th colspan="4" class="text-center bg-secondary text-white">
	              <h5 class="mt-1 mb-1">Payment Summary</h5>
	            </th>
          	</tr>

          	<tr>
	            <th>Total Bill</th>
	            <th>Total Pay</th>
	            <th>Remaining Balance</th>
	            <th>Notes</th>
          	</tr>

        </thead>

        <tbody>
	        	<tr>
	        		<td></td>
	        		<td></td>
	        		<td></td>
	        		<td>{!! $sales_order->notes !!}</td>
	        	</tr>
        </tbody>

      	</table>  

@endsection
