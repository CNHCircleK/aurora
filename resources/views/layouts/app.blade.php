<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') | {{ config('app.name', 'Laravel') }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
      window.Laravel = <?php echo json_encode( [
			'csrfToken' => csrf_token(),
		] ); ?>
    </script>
</head>
<body>
<div id="app">
    <header class="banner">
        <div class="container container_no-padding">
            <nav class="navbar navbar-default">
                <div class="masthead">
                    <div class="masthead__logos">
                        <div class="masthead__left">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/cki_wordmark.png') }}"
                                     alt="CKI">
                            </a>
                        </div>

                        <div class="masthead__right">
                            <img src="{{ asset('images/cnh_district_emblem.png') }}"
                                 alt="California-Nevada-Hawaii District of Circle K International">
                        </div>
                    </div>

                    <div class="masthead__stripes"></div>
                </div>

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#primary-nav" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse navbar-collapse-opaque" id="primary-nav">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (!Auth::guest())
                            <li><a href="{{ action('AwardController@index') }}">Awards</a></li>
                            @if (Auth::user()->admin)
                                <li>
                                    <a href="{{ action('TeamController@index') }}">{{ trans_choice('team.teams', 2) }}</a>
                                </li>
                                <li>
                                    <a href="{{ action('InviteController@index') }}">Invitations</a>
                                </li>
                            @else
                                @if (Auth::user()->team)
                                    <li>
                                        <a href="{{ action('TeamController@show', Auth::user()->team->id) }}">
                                            My {{ trans_choice('team.teams', 1) }}
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ action('UserController@edit', \Auth::user()) }}">
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="post__header">
        <div class="header-wrapper header-wrapper_awards">
            <div class="container">
                <div class="header-content">
                    <div class="row row_valign">
                        <div class="col-sm-5">
                            <h1 class="bg-ckinavy">Awards Submissions</h1>
                        </div>
                        <div class="col-sm-7 text-right">
                            <h3>@yield('title')</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            {{-- Flash Messages --}}
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
</div>

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
@yield('after-js')

</body>
</html>
