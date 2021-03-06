<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GkDemy') }}</title>

        <!-- Scripts -->
        <script src="{{asset('js/jquery..js')}}"></script>
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

        <script src="{{ asset('js/prestashop-ui-kit.js') }}" defer></script>

        <script src="{{asset('js/admintab.js')}}"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!-- Latest compiled and minified CSS -->
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
        {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
        <link href="{{ asset('css/bootstrap-prestashop-ui-kit.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('js/jquery-toast-plugin/src/jquery.toast.css') }}" rel="stylesheet">
        
    
        
        @yield('css')
    </head>
    <body>
        <div id="app">
            <header id="header" class="bootstrap">
                <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                    <div>
                        <i class="material-icons mr-2">menu</i>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name') }}
                        </a>
                    </div>
                </nav>
            </header>
            @section('sidebar')
                <nav class="nav-bar d-none d-md-block" role="navigation" id="nav-sidebar">
                    <ul class="list-group main-menu">
                        <li class="list-group-item collapse-drawer gk-cursor-pointer  d-none d-md-block" id="tab-AdminArticles">
                            <span class="menu-collapse">
                                <i class="material-icons">chevron_left</i>
                                <i class="material-icons">chevron_left</i>
                            </span>
                        </li>
                        <li class="link-levelone @if(in_array(Route::currentRouteName(),['posts.index','posts.edit','posts.create'])) active @endif" id="tab-AdminArticles">
                            <a class="link" href="{{ route('posts.index') }}">
                                <i class="material-icons">local_post_office</i>
                                <span>Posts</span>
                            </a>
                        </li>
                        <li class="link-levelone @if(in_array(Route::currentRouteName(),['categories.index','categories.edit'])) active @endif" id="tab-AdminCategories">
                            <a class="link" href="{{ route('categories.index') }}">
                                <i class="material-icons">category</i>
                                <span>{{ __('message.heading') }}</span>
                            </a>
                        </li>
                        <li class="link-levelone @if(in_array(Route::currentRouteName(),['tags.index','tags.edit'])) active @endif" id="tab-AdminTags">
                             <a class="link" href="{{ route('tags.index') }}">
                                <i class="material-icons">category</i>
                                <span>Tags</span>
                            </a>
                        </li>
                        <li class="link-levelone @if(in_array(Route::currentRouteName(),['monthly.index','monthly.edit'])) active @endif" id="tab-AdminCategories">
                            <a class="link" href="{{ route('monthly.index') }}">
                                <i class="material-icons">schedule</i>
                                <span>Monthly Tags</span>
                            </a>
                        </li>

                        <li class="link-levelone @if(in_array(Route::currentRouteName(),['jobs.index','jobs.edit','jobs.create'])) active @endif" id="tab-AdminArticles">
                            <a class="link" href="{{ route('jobs.index') }}">
                                <i class="material-icons">local_post_office</i>
                                <span>Job Posts</span>
                            </a>
                        </li>

                        <li class="link-levelone has_submenu @if(in_array(Route::currentRouteName(),['quiz.index','quiz.edit','quiz.create'])) active @endif" id="tab-AdminArticles">
                            <a class="link" href="{{ route('quiz.index') }}">
                                <i class="material-icons">question_answer</i>
                                <span>Quiz</span>
                                <i class="material-icons sub-tabs-arrow">
                                    keyboard_arrow_down
                                </i>
                            </a>
                            <ul id="collapse-9" class="submenu panel-collapse">
                                <li class="link-leveltwo " id="subtab-AdminProducts" data-submenu="10">
                                    <a href=""
                                        class="link">
                                        Schedule Time
                                    </a>
                                </li>
                                {{-- <li class="link-leveltwo " id="subtab-AdminProducts" data-submenu="10">
                                    <a href=""
                                        class="link">
                                        Category
                                    </a>
                                </li> --}}
                                <li class="link-leveltwo " id="subtab-AdminProducts" data-submenu="10">
                                    <a href="{{ route('quiz.index') }}"
                                        class="link">
                                        Quiz
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="link-levelone " id="tab-AdminLogout">
                            <a class="link" href="{{ route('user.logout') }}">
                                <i class="material-icons">logout</i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </nav>

            @show
            <div id="main">
                <div id="content" class="bootstrap ">
                    <div class="bootstrap">
                        <div class="page-head ">
                            <div class="wrapper clearfix col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{route('move.trash')}}" id="trash_route">
        <script src="{{asset('js/sweetalert.js')}}"></script>
        <script src="{{asset('js/word-count/textcounter.min.js')}}"></script>
        <script src="{{asset('js/custom.counter.js')}}"></script>
        <script src="{{asset('js/jquery-toast-plugin/src/jquery.toast.js')}}"></script>
        {{-- <script src="{{asset('js/admin.tab.js')}}"></script> --}}
        <script>
        @if(Session::has('success'))
        $.toast({
                heading: 'Information',
                text: "{{Session::get('success')['message']}}",
                showHideTransition: 'fade',
                hideAfter: false,
                position: 'mid-center',
                icon: 'info'
        });
        @endif
        </script>
        
        @yield('pagescript')


    </body>
</html>