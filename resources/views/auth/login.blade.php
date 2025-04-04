<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Sistem Inventori Barang</title>
    <link rel="apple-touch-icon" href="{{ asset('images/kantor.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/kantor.png') }}">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px
        }

        .card2 {
            margin: 0px 40px
        }

        .logo {
            width: 110px;
            height: 100px;
            margin-top: 35px;
            margin-left: 35px
        }

        .image {
            height: 300px;
            margin-top: 30px;
        }

        .border-line {
            border-right: 1px solid #EEEEEE
        }

        .facebook {
            background-color: #3b5998;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .twitter {
            background-color: #1DA1F2;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .linkedin {
            background-color: #2867B2;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer
        }

        .line {
            height: 1px;
            width: 45%;
            background-color: #E0E0E0;
            margin-top: 10px
        }

        .or {
            width: 10%;
            font-weight: bold
        }

        .text-sm {
            font-size: 14px !important
        }

        ::placeholder {
            color: #BDBDBD;
            opacity: 1;
            font-weight: 300
        }

        :-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        ::-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        input,
        textarea {
            padding: 10px 12px 10px 12px;
            border: 1px solid lightgrey;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 14px;
            letter-spacing: 1px
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        a {
            color: inherit;
            cursor: pointer
        }

        .btn-blue {
            background-color: #4361ee;
            width: 150px;
            color: #fff;
            border-radius: 2px;
            transition: background-color 0.3s ease, color 0.3s ease; 
        }

        .btn-blue:hover {
            background-color:rgb(22, 57, 216);
            color: #ffffff; 
            cursor: pointer;
        }

        .bg-blue {
            color: #fff;
            background-color: #4361ee
        }

        @media screen and (max-width: 991px) {
            .logo {
                margin-left: 0px
            }

            .image {
                width: 300px;
                height: 220px
            }

            .border-line {
                border-right: none
            }

            .card2 {
                border-top: 1px solid #EEEEEE !important;
                margin: 0px 15px
            }
        }

        .card{
            border-radius: 20px;
            box-shadow: 100px;
        }

        .btn{
            border-radius: 5px;
        }
        .table{
            border-radius: 10px;
        }
        .bg-blue{
            border-radius: 0 0 20px 20px;
            
        }
</style>

</head>

<body oncontextmenu='return false' class='snippet-body'>
    @include('sweetalert::alert')
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card-0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row px-3 justify-content-center mt-3 mb-2 border-line"> <img
                            src="{{ asset('images/kantor.png') }}" class="image"> </div>
                            <div class="row justify-content-center text-center pb-0 pt-2 border-line">
                                <h4><b>Sistem Inventori Barang</b><br>
                                    <b>Pusat Layanan Disabilitas dan Pendidikan Inklusi Prov. Kalsel (PLDPI)</b></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card2 card border-0 px-4 py-5">
                                <div class="row px-3 mb-4 mt-5">
                                    <h3><strong class="or ml-1 mr-1 text-center">Login</strong></h3>
                                </div>
                                {{-- Menampilkan error jika ada --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="/login" method="POST">
                                    @csrf
                                    <div class="row px-3">
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Email Address</h6>
                                        </label>
                                        <input class="mb-4" type="email" name="email" id="email"
                                        placeholder="Enter a valid email address">
                                    </div>
                                    <div class="row px-3">
                                        <label class="mb-1">
                                            <h6 class="mb-0 text-sm">Password</h6>
                                        </label>
                                        <input type="password" name="password" id="password" placeholder="Enter password">
                                    </div>
                                    <div class="row mb-3 px-3 mt-4">
                                        <button type="submit" class="btn btn-blue text-center">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue py-4">
                        <div class="row px-3 rounded"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2025. All rights
                        reserved.</small>
                        <!-- <div class="social-contact ml-4 ml-sm-auto"> </div> -->
                    </div>
                </div>
            </div>
        </div>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
        </script>
        <script type='text/javascript' src=''></script>
        <script type='text/javascript' src=''></script>
        <script type='text/Javascript'></script>
    </body>
    </html>
