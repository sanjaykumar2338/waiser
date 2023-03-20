<!DOCTYPE html>
<html lang="en">
<head>
   @include('professor.include.head')
</head>
<body>
<div class="wrapper">
   @include('professor.include.header')
   @yield('content')
   @include('professor.include.footer')
</div>
</body>
</html>