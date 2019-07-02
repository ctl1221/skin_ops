@extends ('master')

@section('heading')

My Dashboard

@endsection


@section ('contents')

<div class="row">
  <div class="col-8">
    <div class="card">
      <div class="card-header">
        Monthly Branch Quota  - PHP {{ number_format($quota) }}
      </div>
      <div class="card-body">
        <b>Under Construction...</b>
        <br>

        Base
        <div class="progress mb-2">
          <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $current * 100 }}%" aria-valuenow="{{ $current * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        Over
        <div class="progress mb-2">
          <div class="progress-bar bg-success" role="progressbar" style="width: {{ $over * 100 }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{ $over * 100 }}"></div>
        </div>
        <br/>
      </div>
    </div>
  </div>
  <div class="col-4">

    <div class="card">
      <div class="card-header">
        Appointments for Today
      </div>
      <ul class="list-group list-group-flush">
        @if(! count($appointments))
          <li class="list-group-item text-center">None</li>
        @endif
        @foreach($appointments as $x)
          <li class="list-group-item text-center">
            {{ $x->title }}<br/>
            {{ \Carbon\Carbon::parse($x->start)->format('h:i') }} -
            {{ \Carbon\Carbon::parse($x->end)->format('h:i A') }}<br/>
            {{ $x->content }}
          </li>
        @endforeach
      </ul>
    </div>

    {{-- <table class="table table-bordered table-fullwidth table-striped">

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

    </table> --}}

  </div>
</div>


@endsection
