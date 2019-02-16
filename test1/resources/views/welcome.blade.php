<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


        <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('/js/jquery.js') }}"></script>

        <!-- Bootstrap 3.3.2 JS -->
        <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                    <form method="post" id="form" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="input">Input</label>
                            <input type="text" class="form-control" name="input" id='input' value=""  >
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="parenthesis_index">Index of Opening Parenthesis</label>
                            <input type="text" class="form-control" name="parenthesis_index" id='parenthesis_index' value=""  >
                        </div>
                        <!-- /.form-group -->

                        <button class="submit" type="button">Submit</button>
                        
                    </div>
                    <!-- /.row -->

                    </form>

                    <br>
                    <span id="answer"></span>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {

           

            $('.submit').on('click',function(){
                var data = new FormData($('#form')[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN':  $('input[name="_token"]').val()
                    },
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    url : "{{ URL::route('check_parenthesis') }}",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        $('#answer').text("The index of closing parenthesis is "+data);
                    },
                    error: function (jqXHR) {
                        alert(jqXHR['responseJSON']['message']);
                    }
                });
                //return true;
            });
            

        });
    </script>
</html>
