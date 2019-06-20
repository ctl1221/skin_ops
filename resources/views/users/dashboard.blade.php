@extends ('master')

@section('heading')

My Dashboard

@endsection


@section ('contents')

<div class="row">
  <div class="col-8">
    <div class="card">
      <div class="card-body">
        Under Construction
        <br/>
        <br/>
        <br/>
        <br/>
      </div>
    </div>
  </div>
  <div class="col-4">

    <table class="table table-bordered table-fullwidth table-striped">

      <tr>
        <th class="text-center">Appointments for Today</th>
      </tr>
      @if(! count($appointments))
      <tr>
        <td class="text-center">
          None
        </td>
      </tr>
      @endif

      @foreach($appointments as $x)
      <tr>
        <td class="text-center">
          {{ $x->title }}<br/>
          {{ \Carbon\Carbon::parse($x->start)->format('h:i') }} -
          {{ \Carbon\Carbon::parse($x->end)->format('h:i A') }}<br/>
          {{ $x->content }}
        </td>
      </tr>
      @endforeach

    </table>

  </div>
</div>


@endsection
