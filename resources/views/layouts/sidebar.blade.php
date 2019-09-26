<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container-fluid">

    <header class="row">
        @include('includes.header')
    </header>
    <div class="modal-overlay"></div>
    <div id="main" class="row">
        <!-- sidebar content -->
        <div id="sidebar" class="sidebar collapsed">
            @include('includes.sidebar')
        </div>

        <!-- main content -->
        <div id="content-page" class="content-page">
            <div class="page-wrap">
              @yield('content')
            </div>
        </div>
    </div>
    <footer class="row no-margin">
        @include('includes.footer')
    </footer>

</div>
</body>
</html>
