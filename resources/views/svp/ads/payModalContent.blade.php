<form method="post" action="{{$payhere['payhere_action']}}">
        <input type="hidden" name="merchant_id" value="{{$payhere['merchant_id']}}">
        <input type="hidden" name="return_url" value="{{ config('app.url', 'ems.dv') }}/svp/ads/pay/done">
        <input type="hidden" name="cancel_url" value="{{ config('app.url', 'ems.dv') }}/svp/ads/pay/cancel">
        <input type="hidden" name="notify_url" value="{{ config('app.url', 'ems.dv') }}/notify.php">
        <input type="hidden" name="order_id" value="{{$ad->ad_id}}">
        <input type="hidden" name="currency" value="LKR">
        <input type="hidden" class="form-control" id="country" name="country" value="Sri Lanka"/>

            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="validationCustom01">Advetisement Type</label>
                @php
                //Preprocessing Some Data
                  $ad_desc = "";
                  if($ad->type==0) $ad_desc = $ad_desc."Picture: ";
                  else if ($ad->type==1) $ad_desc = $ad_desc."Text: ";

                  if($ad->position == 0) $ad_desc = $ad_desc."Bottom-Pane Advertisement";
                  else if($ad->position == 1) $ad_desc = $ad_desc."Right-Pane Advertisement";
                  else if($ad->position == 2) $ad_desc = $ad_desc."Bottom & Right Pane Advertisement";

                  $address = $svp->address." ".$svp->address2;

                @endphp
                <input type="text" readonly class="form-control" id="items" name="items" placeholder="Picture, Bottom-pane, Right-pane" value="{{$ad_desc}}" required=""/>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="validationCustom01">Price (LKR)</label>
                <input type="text" readonly class="form-control" id="amount" name="amount" placeholder="" value="{{$ad->price}}" required=""/>
                </div>
            </div>
            <div class="row" data-pg-collapsed>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom01">First name</label>
                <input type="text" class="form-control" id="validationCustom01" name="first_name" placeholder="First name" value="{{$svp->firstname}}" required=""/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" name="last_name" placeholder="Last name" value="{{$svp->lastname}}" required=""/>
                </div>
            </div>
            <div class="form-row" data-pg-collapsed>
                <div class="form-group col-md-8
                ">
                    <label for="inputEmail4">Email</label>
                    <input readonly type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$svp->email}}"/>
                </div>
            </div>
            <div class="form-row" data-pg-collapsed>
                <div class="form-group col-md-6">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{$svp->phone}}"/>
                </div>
            </div>
            <div class="form-group" data-pg-collapsed>
                <label for="inputAddress">Address</label>
            <textarea class="form-control" rows="3" name="address">{{$address}}</textarea>
            </div>
            <div class="form-row" data-pg-collapsed>
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{$svp->city}}"/>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
</form>