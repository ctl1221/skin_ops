@extends('master')

@section('heading')

@endsection

@section('contents')

<form method="post" action="/claims/{{ $claim->id }}">
    @csrf

  <div class="form-group">
    <label for="so_number">SO Number</label>
    <input type="text" class="form-control" id="so_number" value="{{ $claim->parent->so_number }}" disabled>
  </div>

  <div class="form-group">
    <label for="claimed_by_id">Claimed By</label>
    <input type="text" class="form-control" id="claimed_by_id" value="{{ $claim->claimed_by->display_name() }}" disabled>
  </div>

  <div class="form-group">
    <label for="claimed_by_date">Current Claim Date: <b>{{ Carbon\Carbon::parse($claim->claimed_by_date)->toFormattedDateString() }}</b> </label>
    <input type="date" class="form-control" id="claimed_by_date" value="{{ $claim->claimed_by_date }}">
  </div>

  <div class="form-group">
    <label for="sellable_id">Current Service: <b>{{ $claim->sellable->name }}</b></label>
    <select class="form-control" id="service" name="service" required >
      @foreach ($services as $x)
        <option value={{ $x->id }} 
          @if($x->id == $claim->sellable->id)
            {{ "selected = 'selected'" }} 
          @endif> 
        {{ $x->name }} </option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="treated_by_id">Current Treated By: <b>{{ $claim->treated_by->display_name() }}</b></label>
    <select class="form-control" id="treated_by_id" name="treated_by_id" required >
      @foreach ($employees as $x)
        <option value={{ $x->id }} 
          @if($x->id == $claim->treated_by_id)
            {{ "selected = 'selected'" }} 
          @endif> 
        {{ $x->display_name() }} </option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="branch_id">Current Branch: <b>{{ $claim->branch->name }}</b></label>
    <select class="form-control" id="branch_id" name="branch_id" required >
      @foreach ($branches as $x)
        <option value={{ $x->id }} 
          @if($x->id == $claim->branch_id)
            {{ "selected = 'selected'" }} 
          @endif> 
        {{ $x->name }} </option>
      @endforeach
    </select>
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

