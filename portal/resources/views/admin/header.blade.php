@php
    $users=\Auth::user();
    $userLang=\Auth::user()->lang;
    $profile=asset(Storage::url('upload/profile'));
@endphp
<!-- Header Start-->
<header class="codex-header">
    <div class="header-contian d-flex justify-content-between align-items-center">
        <div class="header-left d-flex align-items-center">
            <div class="sidebar-action navicon-wrap"><i data-feather="menu"></i></div>
        </div>
        <div class="header-right d-flex align-items-center justify-content-end">
            <ul class="nav-iconlist">
                @if(\Auth::user()->type=='super admin' || \Auth::user()->type=='owner')
                    <li data-bs-toggle="tooltip" data-bs-original-title="{{__('Theme Settings')}}"
                        data-bs-placement="bottom">
                        <div class="navicon-wrap customizer-action"><i class="fa fa-cog"></i></div>
                    </li>
                @endif
                <li class="nav-profile">
                    <div class="media">
                        <div class="user-icon">
                            <img class="img-fluid rounded-50"
                                 src="{{ !empty($users->profile) ? $profile.'/'.$users->profile : $profile.'/avatar.png' }}"
                                 alt="logo">
                        </div>
                        <div class="media-body">
                            <h6>{{ \Auth::user()->name }}</h6>
                            <span class="text-light">{{ \Auth::user()->type }}</span>
                        </div>
                    </div>
                    <div class="hover-dropdown navprofile-drop">
                        <ul>
                            <li><a href="{{ route('setting.account') }}"><i class="ti-user"></i>{{ __('Profile') }}</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- Header End-->
