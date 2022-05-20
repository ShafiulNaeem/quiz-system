<ul class="d-flex align-items-center flex-wrap">

    <li class="user_img">
        <div id="userImage">
            <img
                src="{{asset('assets/images/user_img.jpg')}}"
                alt="user image"
            />
            <span>{{ Auth::user()->name }}</span>
        </div>

        <div class="profile_dropdown_area" id="profileDropdown">
            <div class="profile_overlay" id="profileOverlay"></div>
            <ul>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Sign Out') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </li>
</ul>
