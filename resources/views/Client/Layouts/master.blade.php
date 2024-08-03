<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Reader | Hugo Personal Blog Template</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Hugo 0.74.3" />

    <!-- theme meta -->
    <meta name="theme-name" content="reader" />

    <!-- plugins -->
    <link rel="stylesheet" href="{{ asset('client/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/slick/slick.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}" media="screen">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('client/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('client/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <meta property="og:title" content="Reader | Hugo Personal Blog Template" />
    <meta property="og:description" content="This is meta description" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:updated_time" content="2020-03-15T15:40:24+06:00" />
</head>

<body>
    <!-- navigation -->
    <header class="navigation fixed-top">
        <div class="container">
            @include('Client.Layouts.header')
        </div>
    </header>
    <!-- /navigation -->

    <!-- start of banner -->
    @include('Client.Layouts.banner')
    <!-- end of banner -->
    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('Client.Layouts.footer')


    <!-- JS Plugins -->
    <script src="{{ asset('client/plugins/jQuery/jquery.min.js') }}"></script>

    <script src="{{ asset('client/plugins/bootstrap/bootstrap.min.js') }}"></script>

    <script src="{{ asset('client/plugins/slick/slick.min.js') }}"></script>

    <script src="{{ asset('client/plugins/instafeed/instafeed.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/scripts/verify.min.js"></script>

    <!-- Main Script -->
    <script src="{{ asset('client/js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.post-title').on('click', function(e) {
                e.preventDefault();
                var postId = $(this).data('id');
                var url = $(this).attr('href');

                $.ajax({
                    url: '{{ route('increment-view') }}',
                    type: 'POST',
                    data: {
                        id: postId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = url;
                        } else {
                            console.error('Failed to increment view.');
                            window.location.href = url;
                        }
                    },
                    error: function() {
                        console.error('Error in AJAX request.');
                        window.location.href = url;
                    }
                });
            });
        });
    </script>

</body>

</html>
