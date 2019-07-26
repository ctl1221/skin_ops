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
        Base - {{ number_format($current * $quota) }} / {{ number_format($quota) }}
        <div class="progress mb-2" style="height: 30px;">
          <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $current * 100 }}%" aria-valuenow="{{ $current * 100 }}" aria-valuemin="0" aria-valuemax="100">
            {{ number_format($current * 100 > 100 ? 100 : $current * 100) }}%
          </div>
        </div>
        Over - {{ number_format($over * $quota) }}
        <div class="progress mb-2" style="height: 30px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: {{ $over * 100 }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{ $over * 100 }}">
            {{ number_format($over * 100) }}%
          </div>
        </div>
        <br/>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header">
        Availment Counts - {{ \Carbon\Carbon::now()->format('F Y') }}
      </div>
       @foreach($items as $key => $value)
         <li class="list-group-item text-center">
          {{ $key }} - {{ $value }}
        </li>
        @endforeach
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

  <div class="card mt-3">
    <div class="card-header">
      Claims - {{ \Carbon\Carbon::now()->format('F Y') }}
    </div>
    @foreach($claims as $key => $value)
     <li class="list-group-item text-center">
      {{ $key }} - {{ $value }}
      </li>
    @endforeach
</div>

</div>



</div>

@endsection
