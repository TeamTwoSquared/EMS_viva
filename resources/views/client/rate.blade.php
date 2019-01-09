@php
use App\Review;
use App\Reviewing;
use App\Booking;

    $client = session()->get('customer_id');
    $booking = Booking::find($ett->booking_id);
    $svp = $booking->service_provider_id;
    $service = $ett->service_id;

@endphp

<form name = "rateFrm" id="rateFrm">
        <div class="form-group">
          <label for="message-text" class="col-form-label">Your Review :</label>
          <textarea class="form-control" name="reviewText" row="3" id="reviewText" placeholder="Let us know your experience with service provider..."></textarea>
        </div>
        <input type="hidden" value="{{$client}}" name ="client" />
        <input type="hidden" value="{{$svp}}" name ="svp"/>
        <input type="hidden" value="{{$service}}" name ="service"/>
        <input type="hidden" value="{{$ett->event_id}}" name ="event"/>
        <input type="hidden" value="{{$ett->task_id}}" name ="task"/>

        <div class="form-group" id="rating-ability-wrapper">
                <label class="control-label" for="rating">
                <span class="field-label-header">Rate Service Provider :</span><br>
                <span class="field-label-info"></span>
                <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                </label>
                <h2 class="bold rating-header" style="">
                <span class="selected-rating">0</span><small> / 5</small>
                </h2>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" name="savenew" id="savenew" class="btn btn-primary">Rate</button>
        </div>
        
</form>

<script>
	jQuery(document).ready(function($){
	    
        $(".btnrating").on('click',(function(e) {
        
        var previous_value = $("#selected_rating").val();
        
        var selected_value = $(this).attr("data-attr");
        $("#selected_rating").val(selected_value);
        
        $(".selected-rating").empty();
        $(".selected-rating").html(selected_value);
        
        for (i = 1; i <= selected_value; ++i) {
        $("#rating-star-"+i).toggleClass('btn-warning');
        $("#rating-star-"+i).toggleClass('btn-default');
        }
        
        for (ix = 1; ix <= previous_value; ++ix) {
        $("#rating-star-"+ix).toggleClass('btn-warning');
        $("#rating-star-"+ix).toggleClass('btn-default');
        }
        
        }));

        $('#savenew').click(function(){
            $.ajax({
                    type:'POST',
                    url:'/client/review/new',
                    data:$('#rateFrm').serialize(),
                    success:function(data){
                        window.location.reload(true);
                    }
                });
        });      
    });
    
</script>