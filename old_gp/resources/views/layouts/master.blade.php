<!DOCTYPE html>
<html>
@include("layouts.partials.head")
<body>
    @include("layouts.partials.navbar")
    @include("layouts.partials.jumbotron")

    <div class="container">
        @yield('content')
    </div>
</body>
</html>