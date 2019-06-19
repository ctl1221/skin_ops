@extends ('master')

@section('heading')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/payments">Payments</a></li>
		<li class="breadcrumb-item active" aria-current="page">PY{{ " "}}</li>
	</ol>
</nav> 
@endsection

@section('contents')

<div class="container mb-5">
	<div class="card">
		<div class="card-body">

			<div class="form-group">
				<label for="branch">Client:</label>
				<input type="text" class="form-control" id="branch" value="{!! $payment->client_name() !!}" disabled>
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
				<label for="reference">Reference:</label>
				<input type="text" class="form-control" value="{{ $payment->reference }}" disabled>
			</div>

			<div class="form-group">
				<label for="notes">Notes:</label>
				<textarea class="form-control" row="3" disabled>{{ $payment->notes }}</textarea>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

@endsection