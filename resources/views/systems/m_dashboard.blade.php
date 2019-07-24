@extends ('master')

@section('heading')

  Manager's Dashboard 

  <span class="float-right">
  @if($period_to_show == 'current')
    <a href="/m_dashboard?period=previous" class="btn btn-outline-secondary">
      {{ \Carbon\Carbon::now()->format('F Y') }}</a>
  @else
    <a href="/m_dashboard?period=current" class="btn btn-outline-secondary">
      {{ \Carbon\Carbon::parse('last month')->format('F Y') }}
    </a>
  @endif
</span>

@endsection

@section ('contents')

<div class="row">
  @foreach($branches as $branch)

    <div class="col">
      <div class="card mb-3" style="background-color: {{ $branch->color }}">
        <h3 class="text-center pt-2">
          {{ $branch->name }}
        </h3>
      </div>

      @php
        $current = $branch->currentMonthlySales(Carbon\Carbon::parse($dates[0]));
        $quota = $branch->quota;
        $prog = number_format($current/$quota*100,0);
      @endphp

      <div class="card"> 
        <my-vue-circle
          prog="{{ $prog }}"
          fill="{{ $branch->color }}"
          >
          Current: {{ $current }}<br/>
          Quota: {{ $quota }}
        </my-vue-circle>

      </div>
      @foreach ($dates as $date)
        <daily-card 
          date="{{ $date }}

          ">
        </daily-card>
      @endforeach
    </div> 

  @endforeach
</div>


@endsection

@section('scripts')
  
  <script type="text/javascript">
  var app = new Vue({
      
      el: '#app',
      data: {},
  });
  </script>

@endsection
