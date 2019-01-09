@if(count($newCommentNotificationForHelp)==1)
    <?php
        $newHelpRequest = DB::table('notifications')->where('is_read',0)->where('type',2)->where('to_whome',2)->where('customer_id',session()->get('customer_id'))->get();
        
    ?>                
        <a href='/client/notification/{{$newHelpRequest[0]->notification_id}}'><div class='notifi__item'> 
            <div class='bg-c3 img-cir img-40'> 
                <i class='zmdi zmdi-file-text'></i> 
            </div>                                                     
            <div class='content'> 
                <p>{{$newHelpRequest[0]->notification}}</p> 
            </div>                                                     
        </div> 
        </a>
@endif
@if(count($newCommentNotificationForHelp)>1){
    <a href='/client/support'><div class='notifi__item'> 
                <div class='bg-c3 img-cir img-40'> 
                    <i class='zmdi zmdi-file-text'></i> 
                </div>                                                     
                <div class='content'> 
                    <p>You Have <b>{{count($newCommentNotificationForHelp)}}</b> Notifications From EMS Support Center</p>
                </div>                                                     
            </div>  
    </a>
@endif


