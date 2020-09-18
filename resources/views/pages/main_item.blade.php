<div class="panel-body">
    <div class="row">
        <div class="col-md-5">
            <form class="form-horizontal form-bordered" method="get">
                <div class="form-group">
                    <h3 class="col-sm-12 text-center text-dark control-label">All Available Items</h3>
                       {{ Form::open(array('method'=>'get','class'=> 'row','url' => 'add-items', 'id'=>'add')) }}
                        <div class="col-sm-8">
                             @php
                            $total=$items->where('status',1);
                            @endphp
                            @foreach( $total as $key=> $single)
                            <div class="radio-custom">
                                <input type="radio" value="{{$single->id}}" id="radioExample_{{$single->id}}" class="add" name="add_items[]">
                                <label for="radioExample_{{$single->id}}">{{$single->title}}</label>
                            </div>
                            @endforeach

                        </div>
                        {{ Form::close() }}
                </div>
            </form>
        </div>
        
        <div id="add-_and_remove" class="col-md-2">
            <button id="add_button" type="button" class="mb-xs mt-xs mr-xs btn btn-primary"> &nbsp; Add  &nbsp; </button><br>
            <button type="button" id="delete_button" class="mb-xs mt-xs mr-xs btn btn-warning">Remove </button>
        </div>
        
        <div class="col-md-5">
            <form class="form-horizontal form-bordered" method="get">
                <div class="form-group">
                    <h3 class="col-sm-12 text-center text-primary control-label">Added Items</h3>
                     {{ Form::open(array('method'=>'get','class'=> 'row','url' => 'delete-items', 'id'=>'delet')) }}
                        <div class="col-sm-8">
                            @php
                            $added=$items->where('status',0);
                            @endphp
                            @foreach( $added as $key=> $item)
                            <div class="radio-custom">
                                <input type="radio"  value="{{$item->id}}" id="radioExample_{{$item->id}}" class="delete" name="delete_items[]">
                                <label for="radioExample_{{$item->id}}">{{$item->title}}</label>
                            </div>
                            @endforeach

                        </div>
                        {{ Form::close() }}
                 
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function () {
        $("body").on("click", "#add_button", function (e) {
         
            var item = $(".add:checked").val();
          $.ajax({
                  url: "{{ URL::to('/add-items') }}",
                  type: "get",
                  data: {
                     'item':item
                  },
                  success: function (data) {
                      if( data !==null){
                        $('#variable_section').html(data);
                        $('#default_sections').hide(data);
                    }
                  }
              });
            

        });
        $("body").on("click", "#delete_button", function (e) {
             if (!confirm("Do you really want to do this?")) {
                            return false;
             }
          
            var item = $(".delete:checked").val();
          $.ajax({
                  url: "{{ URL::to('/delete-items') }}",
                  type: "get",
                  data: {
                     'item':item
                  },
                  success: function (data) {
                      if( data !==null){
                        $('#variable_section').html(data);
                        $('#default_sections').hide(data);
                    }
                  }
              });
            

        });
    });

</script>