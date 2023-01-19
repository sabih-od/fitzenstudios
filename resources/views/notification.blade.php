<style>
   
</style>
<div class="row">
    <div class="col-md-6">
        <h2 class="secHeading">Notifications</h2>
    </div>
    <div class="col-md-12">
        @forelse($notifications as $notify)
            <div class="performCard d-block" @if(!$notify->is_read) style="background-color: #eeaa1b;color: #fff; font-weight: bold;font-size: 18px;" @endif>
                <p>
                    {{ $notify->notification }}
                </p>
                <span>{{ date_diff(new \DateTime($notify->created_at), new \DateTime())->format("%i minutes"); }} ago</span>
                {{-- <span>{{ date_diff(new \DateTime($notify->created_at), new \DateTime())->format("%i Minuts"); }}</span> --}}
            </div>
        @empty
            <div class="performCard d-block">
                <p>
                    There is no notification.
                </p>
            </div>
        @endforelse
    </div>
</div>