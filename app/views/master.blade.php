<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
    <!--<![endif]-->
<meta charset="utf-8" />
KodeInfo Secure Login System
            <link href="styles.css" rel="stylesheet" type="text/css" />
        <!-- Latest compiled and minified CSS -->
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" /><script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script><script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 <!-- Latest compiled and minified JavaScript --></pre>
<div class="container"><section id="content">@if($errors->has())
<div class="alert alert-danger"><button class="close" type="button" data-dismiss="alert">
 ×
 </button>
 @foreach ($errors->all() as $error)
<ul>
    <li>{{ $error }}</li>
</ul>
 @endforeach</div>
 @endif
 
 @if(Session::has('error_msg'))
<div class="alert alert-danger">{{Session::get('error_msg')}}</div>
 @endif
 
 @if(Session::has('success_msg'))
<div class="alert alert-success">{{Session::get('success_msg')}}</div>
 @endif
 
 @yield('content')</section></div>
<pre>