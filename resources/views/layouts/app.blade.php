<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale-1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GkDemy') }}</title>

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

        <script src="{{ asset('js/prestashop-ui-kit.js') }}" defer></script>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="{{asset('js/jquery..js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-prestashop-ui-kit.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
        
    </head>
    <body>
        <div id="app">
            <header id="header" class="bootstrap">
                <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name') }}
                    </a>
                </nav>
            </header>
            @section('sidebar')
                <nav class="nav-bar d-none d-md-block" role="navigation" id="nav-sidebar">
                    <ul class="list-group main-menu"">
                        <li class="list-group-item" id="tab-AdminArticles">
                            <a class="link" href="">
                                <i class="material-icons">local_post_office</i>
                                <span>Posts</span>
                            </a>
                        </li>
                        <li class="list-group-item @if(in_array(Route::currentRouteName(),['categories.index','categories.edit'])) active @endif" id="tab-AdminCategories">
                            <a class="link" href="{{ route('categories.index') }}">
                                <i class="material-icons">category</i>
                                <span>{{ __('message.heading') }}</span>
                            </a>
                        </li>
                        <li class="list-group-item @if(in_array(Route::currentRouteName(),['tags.index','tags.edit'])) active @endif" id="tab-AdminTags">
                             <a class="link" href="{{ route('tags.index') }}">
                                <i class="material-icons">category</i>
                                <span>Tags</span>
                            </a>
                        </li>
                        <li class="list-group-item" id="tab-AdminCategories">
                            <a class="link" href="{{ route('categories.index') }}">
                                <i class="material-icons">schedule</i>
                                <span>Monthly CA</span>
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
                                    <div class="col-md-2 pl-0">
                                    </div>
                                    <div class="col-md-10">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        @yield('pagescript')


    </body>
</html>