<!-- Ads Payment Confirm -->
<!-- Modal -->
<div class="modal fade" id="adsPayModal" tabindex="-1" role="dialog" aria-labelledby="adsPayModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adsPayModalLabel">Confirm Payment Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;">
            <img src="/images/ajax-loader.gif">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </div>

         <!-- content will be load here -->                          
         <div id="dynamic-content"></div>

      </div>
    
    </div>
  </div>
</div>

<!-- Service Video Play Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div>
            <iframe width="100%" height="350" src=""></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Client Reservation Models -->
<div class="modal fade bd-reservation-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="modal-loader-reserve" style="display: none; text-align: center;">
          <img src="/images/ajax-loader.gif">
      </div>

         <!-- content will be load here -->                          
         <div id="dynamic-content-reserve"></div>
    </div>
  </div>
</div>

<!--Rating Modal-->
<div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rateModalLabel"><strong> Rate Service Provider </strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="modal-loader-rate" style="display: none; text-align: center;">
              <img src="/images/ajax-loader.gif">
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Rate</button>
              </div>
          </div>
  
           <!-- content will be load here -->                          
           <div id="dynamic-content-rate"></div>
  
        </div>
      
      </div>
    </div>
  </div>
<!-- svp delete account model-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Delete Account</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
              <div>
                  <h6>Are you sure do you want to delete the account ?</h6>
              </div>
            <form action="/svp/account/delete/{{session()->get('svp_id')}}" method='post'>
              {{ csrf_field() }}
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label" ></label>
                    <input type="password" class="form-control" name='pass' placeholder="Enter your password">
                  </div>
                </div>
                <div class="modal-footer">
                  <button  class="btn btn-danger">Delete account</button>
                </div>
          </form>
        </div>
      </div>
    </div>