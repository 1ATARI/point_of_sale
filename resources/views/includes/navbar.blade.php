
<nav class="main-header navbar navbar-expand navbar-white navbar-light d-flex flex-row">
    <!-- Left navbar links -->
    <ul class="nav navbar-nav ">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
         <li class="nav-item d-none d-sm-inline-block ">
            <a href="{{route('dashboard.welcome')}}" class="nav-link">@lang('msite.Home')</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('dashboard.aboutus')}}" class="nav-link">@lang('msite.aboutus')</a>
        </li>

    </ul>



    <!--right navbar-->
    <ul class="navbar-nav ml-auto">


    </ul>


    <ul class="nav navbar-nav ml-0">
        <div class="btn-group mb-1 mr">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <i class="flag-icon flag-icon-eg mr-2"></i>
                @else
                    {{ LaravelLocalization::getCurrentLocaleName() }}
                    <i class="flag-icon flag-icon-us mr-2"></i>
                @endif
            </button>
            <div class="dropdown-menu">

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                        @if($localeCode =='en')

                            <i class="flag-icon flag-icon-us mr-2"></i>

                        @else
                            <i class="flag-icon flag-icon-eg mr-2"></i>

                        @endif
                    </a>

                @endforeach
            </div>
        </div>



        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{ auth()->user()->image_path }}" alt="avatar" class="img-sm img-circle">


            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0">{{auth()->user()->first_name .' '. auth()->user()->last_name }}</h5>
                            <span>{{auth()->user()->email}}</span>
                        </div>
                    </div>
                </div>

                <a class="dropdown-item" href="{{ route('dashboard.users', ['userId' => Auth::id()]) }}"><i class="text-info ti-settings"></i>@lang('msite.settings')</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="text-danger ti-unlock"></i>{{ __('msite.logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

