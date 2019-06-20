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