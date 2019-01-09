@if($newNotificationForHelp==1)
    @if($newCommentNotificationForHelp==0)
        <?php
            $newHelpRequest = DB::table('notifications')->where('is_read',0)->where('type',1)->where('to_whome',1)->get();
        ?>
        <a href='/admin/notification/{{$newHelpRequest[0]->notification_id}}'><div class='notifi__item'> 
                <div class='bg-c3 img-cir img-40'> 
                    <i class='zmdi zmdi-file-text'></i> 
                </div>                                                     
                <div class='content'> 
                    <p>{{$newHelpRequest[0]->notification}}</p> 
                </div>                                                     
            </div> 
        </a> 
    @endif

    @if($newCommentNotificationForHelp >= 1)
        <?php 
            //$newHelpRequest = DB::table('notifications')->where('is_read',0)->value('notification');
            $newNotifications=($newCommentNotificationForHelp+1);
        ?>    
        <a href='/admin/notification'><div class='notifi__item'> 
            <div class='bg-c3 img-cir img-40'> 
                <i class='zmdi zmdi-file-text'></i> 
            </div>                                                     
            <div class='content'> 
                <p>You Have <b>{{$newNotifications}}</b> From Support Center </p>  
            </div>                                                     
        </div> 
        </a> 
    @endif
    
@endif
@if($newNotificationForHelp>1)
    @if($newCommentNotificationForHelp==0)
        <a href='/admin/support'><div class='notifi__item'> 
                <div class='bg-c3 img-cir img-40'> 
                    <i class='zmdi zmdi-file-text'></i> 
                </div>                                                     
                <div class='content'> 
                    <p>You Have <b>{{$newNotificationForHelp}}</b> Support Request Notifications .</p> 
                    
                </div>                                                     
        </div> 
    @endif
    @if($newCommentNotificationForHelp>=1)
            <a href='/admin/support'><div class='notifi__item'> 
                <div class='bg-c3 img-cir img-40'> 
                    <i class='zmdi zmdi-file-text'></i> 
                </div>                                                     
                <div class='content'> 
                    <p>You Have <b>{{$numOfAllNotificationforHelp}}</b>  Notifications From Support Center</p> 
                   
                </div>                                                     
            </div>
    @endif
@endif
@if($newNotificationForHelp==0)
    @if($newCommentNotificationForHelp==1)
        <?php
            $newHelpRequest = DB::table('notifications')->where('is_read',0)->where('type',2)->where('to_whome',1)->value('notification');
        ?>                
            <a href='/admin/notification'><div class='notifi__item'> 
                <div class='bg-c3 img-cir img-40'> 
                    <i class='zmdi zmdi-file-text'></i> 
                </div>                                                     
                <div class='content'> 
                    <p>{{$newHelpRequest}}</p> 
                   
                </div>                                                     
            </div> 
            </a>
    @endif
    @if($newCommentNotificationForHelp>1)
        <a href='/admin/support'><div class='notifi__item'> 
                    <div class='bg-c3 img-cir img-40'> 
                        <i class='zmdi zmdi-file-text'></i> 
                    </div>                                                     
                    <div class='content'> 
                        <p>You Have <b>{{$newCommentNotificationForHelp}}</b> Feedback Notifications From Support Center</p> 
                       
                    </div>                                                     
                </div>  
        </a>
    @endif
@endif
