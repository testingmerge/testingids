<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="{{ asset('assets/installer/bootstrap.min.css') }}" />
<style>

.container{

width: 768px;
margin-top: 50px;

}

#white_screen
{
position:absolute;height:100%;width:100%;background-color: #FFF;top:0px;left:0px;display:none;z-index:200;
background: rgb(255, 255, 255);
opacity:0.8;
text-align: center;

}
</style>
</head>
<body>
<div id="white_screen">
<div style="position:absolute;top:200px;left:500px;text-align:center;">
<h4>Installation Complete</h4>
<a href="{{ URL::base() }}" class="btn btn-xs btn-success">Open Website</a>
</div>
</div>
<div class="container">

@yield('content')

</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/installer/bootstrap.min.js') }}"></script>

@yield('scripts')

</body>
</html>