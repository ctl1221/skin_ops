@extends('master')

@section('heading')

@endsection

@section('contents')

<form>

  <div class="form-group">
    <label for="so_number">SO Number</label>
    <input type="text" class="form-control" id="so_number" value="{{ $claim->parent->so_number }}">
  </div>

  <div class="form-group">
    <label for="claimed_by_date">Claim Date</label>
    <input type="date" class="form-control" id="claimed_by_date" value="{{ $claim->claimed_by_date }}">
  </div>

  <div class="form-group">
    <label for="sellable_id">Service</label>
    <input type="text" class="form-control" id="sellable_id" value="{{ $claim->sellable->name }}">
  </div>

  <div class="form-group">
    <label for="claimed_by_id">Claimed By</label>
    <input type="text" class="form-control" id="claimed_by_id" value="{{ $claim->claimed_by->display_name() }}">
  </div>

  <div class="form-group">
    <label for="treated_by_id">Treated By</label>
    <input type="text" class="form-control" id="treated_by_id" value="{{ $claim->treated_by->display_name() }}">
  </div>

  <div class="form-group">
    <label for="branch_id">Branch</label>
    <input type="text" class="form-control" id="branch_id" value="{{ $claim->branch->name }}">
  </div>

  {{-- <a href="/claims/{{ $claim->id }}/delete"><button type="button" class="btn btn-danger">Delete</button> --}}
  <a href="/clients/{{ $claim->parent->client->id }}"><button type="button" class="btn btn-warning">Cancel</button>

</form>

<br>
<br>

<form method="post" action="/claims/{{ $claim->id }}/unclaim">

	@csrf

	<input type="submit" value="Unclaim" class="btn btn-secondary">

</form>

@endsection

