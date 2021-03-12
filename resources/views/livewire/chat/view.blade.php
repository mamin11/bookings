<div class="container mt-3">
    <div class="messaging" wire:poll>
        <div class="inbox_msg">
            <div class="inbox_people">
            <div class="headind_srch">
                <div class="recent_heading">
                <h4>Recent</h4>
                </div>
                <div class="srch_bar">
                <div class="stylish-input-group">
                    <input type="text" class="search-bar"  placeholder="Search" >
                    <span class="input-group-addon">
                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                    </span> </div>
                </div>
            </div>
            
            <div class="inbox_chat">
                @foreach($users as $user)
                @if((Auth::user()->user_id === $user->user_id) || ((Auth::user()->role_id == 3)  && ( $user->role_id == 3)) )
                
                @else
                            <div class="chat_list cursor-pointer {{ $activeConvoID === $user->user_id ? 'active_chat' : '' }}" wire:click='setAciveChat({{$user->user_id}})'>
                                <div class="chat_people">
                                    <div class="chat_img"> <img src="{{$user->getStaffProfilePic()}}" alt="user profile image" class="img-thumbnail" style="float:left; vertical-align: middle; width: 60px; height: 50px; border-radius: 50%;"> </div>
                                    <div class="chat_ib">
                                    <h5>{{$user->name}} <span class="chat_date"></span></h5>
                                    @if($user->getLatestMessage())    
                                        @if(($user->getLatestMessage()->sender === Auth::user()->user_id || $user->getLatestMessage()->receiver === Auth::user()->user_id))
                                        <p>{{$user->getLatestMessage()->message}} @if(($user->getLatestMessage()->status === 1)  && ($user->getLatestMessage()->sender !== Auth::user()->user_id )) <img class="float-right" src="https://img.icons8.com/cotton/24/000000/topic-push-notification.png"/>  @endif</p>
                                        @else
                                        <p>Start conversation</p>
                                        @endif
                                    @else
                                    <p>Start conversation</p>
                                    @endif
                                    </div>
                                </div>
                            </div>                    
                    @endif

                @endforeach


            </div>

            </div>
            <div class="mesgs">

            <div class="msg_history">
                
                    @if($activeConvoID)
                        @foreach ($activeUser->getMessages() as $message)
                            @if($message->sender === Auth::user()->user_id || $message->receiver === Auth::user()->user_id)
                                <div class="@if($message->sender === Auth::user()->user_id) outgoing_msg @else incoming_msg @endif">
                                    <div class="@if($message->sender === Auth::user()->user_id) sent_msg @else received_withd_msg @endif ">
                                        <p>{{$message->message}}</p>
                                        <span class="time_date">{{ $message->created_at->diffForHumans()}}</span> 
                                    </div>
                                </div>
                            @endif

                        @endforeach
                        
                    @endif


            </div>
            <div class="type_msg">
                <div class="input_msg_write">
                    <form wire:submit.prevent="sendMessage">
                        <input @if(!$activeConvoID) disabled @endif type="text" wire:model.defer='formInput' class="write_msg" placeholder="Type a message" />
                        <a wire:click.prevent="sendMessage"  class="msg_send_btn" ><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>
                    </form>
                </div>
            </div>
            </div>
        </div>
        
        
        
        </div>
    </div>