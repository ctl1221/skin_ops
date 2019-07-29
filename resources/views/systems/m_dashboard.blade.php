@extends ('master')

@section('heading')

  Manager's Dashboard 

  <span class="float-right">
    <span class="badge badge-secondary"></span>
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

{{-- <div class="row">
  <div class="col">
    <div class="card mb-3 bg-warning">
      <h3 class="text-center pt-2">
        ---
      </h3>
    </div>
  </div>
</div> --}}

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
        $overall = $branch->currentOverallSales(Carbon\Carbon::parse($dates[0]));
        $probeauty_sales = $branch->currentProBeautySales(Carbon\Carbon::parse($dates[0]));
      @endphp

      <div class="card py-3"> 
        <my-vue-circle
          :prog="{{ $prog }}"
          fill="{{ $branch->color }}"
          >
            <table>
              <tr>
                <td>Quota:</td>
                <td class="text-right">{{ number_format($quota,2) }}</td>
              </tr>

              <tr>
                <td>Current:</td>
                <td class="text-right">{{ number_format($current,2) }}</td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="{{ $branch->color }}"></td>
              </tr>
              <tr>
                <td>Probeauty Sales:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="text-right">{{ number_format($probeauty_sales,2) }}</td>
              </tr>
              @if($quota >= $current)
                <tr>
                  <td>Remain:</td>
                  <td class="text-right">{{ number_format($quota - $current,2) }}</td>
                </tr>
              @else
                <tr>
                  <td>Over:</td>
                  <td class="text-right">{{ number_format(($quota - $current) * -1 ,2) }}</td>
                </tr>
              @endif
              <tr>
                <td colspan="2" bgcolor="{{ $branch->color }}"></td>
              </tr>
              <tr>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td colspan="2" bgcolor="{{ $branch->color }}"></td>
              </tr>
              <tr>
                <td>Overall:</td>
                <td class="text-right">{{ number_format($overall,2) }}</td>
              </tr>
              
            </table>
        </my-vue-circle>

      </div>
      @foreach ($dates as $date)
        <daily-card 
          date_string="{{ Carbon\Carbon::parse($date)->toFormattedDateString() }}"
          date="{{ $date }}"
          branch_id={{ $branch->id }}>
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
