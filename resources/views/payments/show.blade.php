@extends ('master')

@section('heading')

<div class="container">
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/payments">Payments</a></li>
		<li class="breadcrumb-item active" aria-current="page">
			{{ $payment->py_number ? 'PY ' . $payment->py_number : 'SO ' . $payment->parent->so_number }}
		</li>
	</ol>
</nav> 


</div>
@endsection

@section('contents')

<div class="container">
	<div class="card">
		<div class="card-body">

			<div class="form-group">
				<label for="branch">Client:</label>
				<a href="/clients/{{$payment->parent_id}}">
					<input type="text" class="form-control" id="branch" value="{!! $payment->client_name() !!}" disabled>
				</a>
			</div>

			<div class="form-group">
				<label for="branch">Branch:</label>
				<input type="text" class="form-control" id="branch" value="{{ $payment->branch->name }}" disabled>
			</div>

			<div class="form-group">
				<label for="date">Date:</label>
				<input type="date" class="form-control" id="date" name="date" value="{{ $payment->date }}" disabled>
			</div>

			<div class="form-group">
				<label for="amount">Amount:</label>
				<input ref="amount" type="number" class="form-control" id="amount" value="{{ $payment->amount}}" disabled>
			</div>

			<div class="form-group">
				<label for="amount">Payment Type:</label>
				<input ref="amount" type="text" class="form-control" id="amount" value="{{ $payment->payment_type->name }}" disabled>
			</div>

			<div class="form-group">
				<label for="or_number">OR Number:</label>
				<input type="text" class="form-control" id="or_number" name="or_number" value="{{ $sales_order->or_number }}" disabled>
			</div>

			<div class="form-group">
				<label for="cif_number">CIF Number:</label>
				<input type="text" class="form-control" id="cif_number" name="cif_number" value="{{ $sales_order->cif_number }}" disabled>
			</div>

			<div class="form-group">
				<label for="reference">Reference:</label>
				<input type="text" class="form-control" value="{{ $payment->reference }}" disabled>
			</div>

			<div class="form-group">
				<label for="notes">Notes:</label>
				<textarea class="form-control" row="3" disabled>{{ $payment->notes }}</textarea>
			</div>
		</div>
	</div>

	@role('management')
	<div class="mt-3">
		<form method="post" action="/payments/{{ $payment->id }}">
			@csrf
			<input type="hidden" name="client_id" value="{{ $payment->parent_id }}">
			<input type="submit" value="Delete" class="btn btn-outline-danger btn-block">
		</form>
	</div>
	@endRole
</div>

@endsection

@section('scripts')

@endsection