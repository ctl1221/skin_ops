@extends ('master')

@section('heading')
	Create Transaction - <a href="/clients/{{ $client->id }}">{{ $client->display_name() }}</a>

@endsection

@section('contents')

<div class="container mb-5">
	<div class="card">
		<div class="card-body">

			<form method="post" action="/payments">

				@csrf

				<input type="hidden" name="client_id" value="{{ $client->id }}">
				<input type="hidden" name="branch_id" value="{{ Auth::user()->branch->id }}">
				<input type="hidden" name="receptionist_id" value="{{ Auth::user()->id }}">

				<div class="form-group">
					<label for="receptionist">Receptionist:</label>
					<input type="text" class="form-control" id="receptionist" value="{{ Auth::user()->name }}" disabled>
				</div>

				<div class="form-group">
					<label for="branch">Branch:</label>
					<input type="text" class="form-control" id="branch" value="{{ Auth::user()->branch->name }}" disabled>
				</div>

				<div class="form-group">
					<label for="date">Date:</label>
					<input type="date" 
						class="form-control" 
						id="date" name="date" 
						value="{{ \Carbon\Carbon::now()->toDateString() }}" 
						min="{{ $min_date }}"
						required>
				</div>

				<div class="form-group">
					<label for="amount">Amount:</label>
					<input ref="amount" type="number" step="0.01" class="form-control" id="amount" name="amount" required autofocus>
				</div>

				<div class="form-group">
					<label for="payment_type">Payment Type:</label>
					<select class="form-control" name="payment_type_id">
						@foreach($payment_types as $x)
						<option value="{{ $x->id }}">{{ $x->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="or_number">OR Number:</label>
					<input type="text" class="form-control" id="or_number" name="or_number">
				</div>

				<div class="form-group">
					<label for="cif_number">CIF Number:</label>
					<input type="text" class="form-control" id="cif_number" name="cif_number">
				</div>

				<div class="form-group">
					<label for="reference">Reference:</label>
					<input type="text" class="form-control" name="reference">
				</div>

				<div class="form-group">
					<label for="notes">Notes:</label>
					<textarea class="form-control" name="notes"></textarea>
				</div>

				<div class="row mt-5">   
					<div class="col-8 mr-0">
						<input type="submit" value="Submit" class="btn btn-outline-success btn-block">
					</div>

					<div class="col-4 ml-0">
						<a href="/clients/{{ $client->id }}">
							<button type="button" class="btn btn-outline-danger btn-block">Cancel</button>
						</a>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

@endsection