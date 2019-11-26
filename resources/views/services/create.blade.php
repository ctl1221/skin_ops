@extends ('master')

@section ('heading')
  Add New Service
@endsection

@section ('contents')

<div class="container">

  <form method="post" action="/services">

    @csrf

  <div class="form-group">
    <label for="service_name">Service Name:</label>
    <input type="text" class="form-control" id="service_name" name="service_name" required>
  </div>

  <br>

    @foreach($pricelists as $x)
    <div class="form-group">
      <label for="{{ $x->name }}">{{ $x->name }} Price:</label>
      <input type="number" class="form-control" id="{{ $x->name }}" name="{{ $x->name }}" min="0" value="0" step="0.01" required>
    </div>
    @endforeach

    <br>

    <button type="submit" class="btn btn-primary">Create</button>
    <a href="/services"><button type="button" class="btn btn-danger">Cancel</button>

  </form>

{{-- @include('partials.errors')  --}}

</div>

@endsection