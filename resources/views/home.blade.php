@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Items Management Page') }}</div>

                <div class="card-body">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <div class="form-group">
                                    
                                        {{ Form::open(array('method'=>'get','class'=> 'row','url' => 'add-selected-items', 'id'=>'addItems')) }}
                                        <label class="col-md-4 control-label" for="inputDefault">Add Items</label>
                                        
                                        <div class="col-md-6 row">
                                            <input type="text" name="item" class="form-control items-input col-md-10" id="item">
                                            <input type="hidden" value="{{Auth::user()->id}}" name="id"  id="id">
                                            <input type="submit" id="submit_form" class="form-control col-md-2" value="Add">
                                        </div>
                                        {{ Form::close() }}
                                </div>
                                
                            </header>
                            <div id="default_sections">
                                    @include('pages.main_item')
                            </div>
                            <div id="variable_section"></div>
                            
                        </section>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function () {
    
        $('#addItems').on('submit', function(e) {
            e.preventDefault(); 
          var  item = $('#item').val();
          var  id = $('#id').val();
//          console.log(item);
              $.ajax({
                  url: "{{ URL::to('/add-selected-items') }}",
                  type: "get",
                  data: {
                     'item':item,'id':id
                  },
                  success: function (data) {
                      if( data !==null){
                       $('#item').val(' ');
                        $('#variable_section').html(data);
                        $('#default_sections').hide(data);
                    }
                  }
              });
        });

    });

</script>
@endsection
