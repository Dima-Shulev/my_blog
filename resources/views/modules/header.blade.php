<header class="py-3 border-bottom">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                @if(\App\Models\Module::select(['name','active'])->where('name','logo')->where('active',1)->first())
                    <x-modules.logo class="{{ active_link('home') }}" href="{{route('home')}}">{{__('Котировки валютных пар')}}</x-modules.logo>
                @endif

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if(\App\Models\Module::select(['name','active'])->where('name','menu')->where('active',1)->first())
                            <x-modules.menu :links="$links"/>
                        @endif

                            <li class="nav">
                                <a class="nav {{ active_link('category*') }}" href="{{ (session('session_status') === 'session_admin') ? route('admin.categories'): (session('session_user') === 'session_auth' ? route('auth.categories'): route('category')) }}">{{__("Категории")}}</a>
                            </li>

                            <li class="nav">
                                <a class="nav {{ active_link('reviews*') }}" href="{{ (session('session_user') === 'session_auth') && (session('session_status') !== 'session_admin') ? route('auth.reviews'): route('reviews') }}">{{__("Отзывы")}}</a>
                            </li>

                            <li class="nav">
                                <a class="nav {{ active_link('charts') }}" href="{{ route('charts') }}">{{__("Диаграммы")}}</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @if((session()->has('session_user')) && (session('session_status') === 'session_user'))
                                <li class="nav">
                                    <b class="nav-link text-dark"><a href="{{route('auth.room.balance')}}" title="{{__('Пополнить')}}">Баланс: {{ session('balance')}}</a></b>
                                </li>

                                <li class="nav">
                                    <a class="nav {{ active_link('login') }}" href="{{ route('auth.room') }}" aria-current="page">{{__("Личный кабинет")}}</a>
                                </li>
                            @else
                                <li class="nav">
                                    <a class="nav {{ active_link('login') }}" href="{{ route('login') }}" aria-current="page">{{__("Вход")}}</a>
                                </li>
                                <li class="nav me-5">
                                    <a class="nav {{ active_link('register') }}"  href="{{ route('register') }}" aria-current="page">{{__("Регистрация")}}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
            </nav>
        </div>
</header>
