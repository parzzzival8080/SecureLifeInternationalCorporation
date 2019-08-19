<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href='https://fonts.googleapis.com/css?family=Montserrat+Sans:300,400,600,700|Material+Icons' rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>

            html, body, section {
                font-family: 'Montserrat', sans-serif;
            }
              /* For V-Cloak */
            [v-cloak] > * { display: none; }
            [v-cloak]::before {
              content: '';
              position: absolute;
              left: 50%;
              top: 50%;
              z-index: 1;
              width: 150px;
              height: 150px;
              margin: -75px 0 0 -75px;
              margin-top: 250px;
              border: 16px solid #FF8F00;
              border-radius: 50%;
              border-top: 16px solid #f0e10e;
              width: 120px;
              height: 120px;
              -webkit-animation: spin 2s linear infinite;
              animation: spin 2s linear infinite;
            }
            @-webkit-keyframes spin {
              0% { -webkit-transform: rotate(0deg); }
              100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
              0% { transform: rotate(0deg); }
              100% { transform: rotate(360deg); }
            }
        </style>
        <title>SecureLife International Corporation</title>
    </head>
    <body >
      <div id="app" v-cloak class="hide-overflow" style="position: relative;">
        <App></App>
      </div>
        <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
    </body>
</html>
