<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
	<head>
	<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>ODOT</title>
		<meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more."/>
		<meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
		<meta name="copyright" content="ZURB, inc. Copyright (c) 2013"/>
		<link rel="stylesheet" href="{{ asset('css/foundation.css') }}"/>
		<script src="{{ asset('js/vendor/modernizr.js') }}"></script>
	</head>
	<body>
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
			<li class="name"><h1><a href="/">ODOT</a></h1></li>
			<li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
			</ul>
			<section class="top-bar-section">
				<ul class="right">
					<li class="divider"></li>
					<li><a href="/">Home</a></li>
					<li class="divider"></li>
					<li><a href="/login">Login</a></li>
					<li class="divider"></li>
					<li><a href="/logout">Logout</a></li>
				</ul>
			</section>
		</nav>
		 
		 @if (Session::has('message'))
		 	<div class="alert-box success">
		 	{{{ Session::get('message') }}}
		 	</div>
		 @endif

		 @if (Session::has('success_msg'))
		 	<div class="alert-box success">
		 	{{{ Session::get('success_msg') }}}
		 	</div>
		 @endif

		 @if (Session::has('error_msg'))
		 	<div class="alert-box alert">
		 	{{ Session::get('error_msg') }}
		 	</div>
		 @endif		 
		 
		<div class="row">
		 	<div class="large-12 columns">
		 		@yield('content')
		 	</div>
		</div>
		 
		 
		<footer class="row">
			<div class="large-12 columns">
				<hr>
				<p>Tom Cawthorn</p>
			</div>
		</footer>
	 
		{{ HTML::script('js/vendor/jquery.js') }}
		{{ HTML::script('js/foundation/foundation.js') }}
		{{ HTML::script('js/app.js') }}
		<script>
		      $(document).foundation();

		      var doc = document.documentElement;
		      doc.setAttribute('data-useragent', navigator.userAgent);
		    </script>
		<script type="text/javascript">
		/* <![CDATA[ */
		(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&"www.cloudflare.com/email-protection"==a.substr(7 ,35)){s='';j=43;r=parseInt(a.substr(j,2),16);for(j+=2;a.length-j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
		/* ]]> */
		</script>
	</body>
</html>