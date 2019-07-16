@extends ('master')

@section('heading')

Manager's Dashboard 

  <button type="button" class="btn btn-secondary">
    <span v-if="monthState == 'previous'">Current</span>
    <span v-else>Previous</span>
  </button>

@endsection

@section ('contents')

<div class="row">
  @foreach($branches as $branch)

    <div class="col">
      <div class="card justify-content-center"> 
        <my-vue-circle>
          Quota: 
        </my-vue-circle>
      </div>
    </div> 

  @endforeach
</div>


@endsection

@section('scripts')
  
  <script type="text/javascript">
  var app = new Vue({
      
      el: '#app',
      data: {   
        monthState: 'previous',            
      },
  });
  </script>

@endsection
