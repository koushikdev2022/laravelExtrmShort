<div class="col-lg-3 dashboard-left">
    <div class="profile">
        <span>{{$this->user->name()}}</span>
        <div class="profile-image">
            <img src="{{$this->user->avatar}}" class="profile-avatar" height="215" alt="Avatar">
        </div>

        <div class="profile-content">
            <h4>My projects</h4>

            <ul>
                <li>
                    <a href="{{route('user.projects')}}?type=all">All</a>
                    <span>{{$all_project}}</span>
                </li>
                <li>
                    <a href="{{route('user.projects')}}?type=publish">Published</a>
                    <span>{{$published}}</span>
                </li>
                <li>
                    <a href="{{route('user.projects')}}?type=progress">In progress</a>
                    <span>{{$in_progress}}</span>
                </li>
                <!-- <li>
                    <a href="#url">Under warranty</a>
                    <span>0</span>
                </li> -->
                <li>
                    <a href="{{route('user.projects')}}?type=completed">Completed</a>
                    <span>{{$completed}}</span>
                </li>
                <li>
                    <a href="{{route('user.projects')}}?type=draft">In draft</a>
                    <span>{{$draft}}</span>
                </li>
            </ul>
        </div>

    </div>
</div>
