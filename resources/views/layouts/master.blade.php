<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    @include('includes.head')

</head>

<body onselectstart="return @if(auth()->user()->hasRole('admin')) true @else false @endif">

    <div class="wrapper">
        @include('includes.sidebar')
        @yield('content')
    </div>

</body>

</html>