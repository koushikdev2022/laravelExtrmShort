<div class="col-lg-9 dashboard-right">
    <div class="dash-bottom-part" wire:poll.30s>
        <div class="dash_headingbx">
            <h2 class="dash_heading pl-0">Notification</h2>
        </div>
        <div class="white_contentbx">
            @forelse ($notifications as $notification)
            <div class="notifi_media">
                <div class="media" wire:key="notification_{{$notification->id}}">
                    <i class="icofont-notification text-success notarea"></i>
                    <div class="media-body">
                        <h5 class="heading {{($notification->is_view === '0') ? 'unread' : ''}}">
                            <a href="{{$notification->url}}?sourefrom=notification&sid={{$notification->id}}">
                                {{$notification->message}}
                            </a>
                        </h5>
                        <span class="date">{{date('h:i A,M d,Y', strtotime($notification->created_at))}}</span>
                    </div>
                    <a href="#" wire:click.prevent="remove({{$notification->id}})" wire:loading.class="d-none"
                        wire:target="remove({{$notification->id}})" class="trash"><i class="icofont-trash"></i>
                    </a>
                    <span class="badge badge-info custloading" type="button" wire:loading
                        wire:target="remove({{$notification->id}})" disabled>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </span>
                </div>
            </div>
            @empty
            <div class="list-card">
                <div class="text-center">
                    <h3 class="font-weight-bold mb-0" style="font-size: 23px;">
                        No notifications found.
                    </h3>
                </div>
            </div>
            @endforelse
        </div>
        <div class="pagintaion bottom-pagination">
            {{$notifications->links() }}
        </div>
    </div>
</div>