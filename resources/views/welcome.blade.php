<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">

        </head>
        <body>
            <div class="container">
                <div class="row mt-5">
                <div class="col-sm-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                        Get access token
                        </div>
                        <h5 id="access_token"></h5>
                        <div class="card-body">

                        <button id="getAccessToken" class="btn btn-primary">Request Access token</button>
                        </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-header">
                            Register Url
                            </div>
                            <div id="response"></div>
                            <div class="card-body">

                            <a href="#" id="registerURL" class="btn btn-primary">Register Urls</a>
                            </div>
                        </div>
                        <br>
                         <div class="card">
                            <div class="card-header">
                            Simulate Transaction
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount">
                                        <label>Account</label>
                                        <input type="text" name="account" class="form-control" id="account">
                                        <br>
                                        <button id="simulate" class="btn btn-primary">Simulate payment</button>
                                    </div>
                                </form>

                            
                            </div>
                        </div>
                </div>
                </div>
                
            </div>
       
    </body>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}">
        
    </script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>

    <script type="text/javascript">

       


    </script>
</html>
