<!-- default boottrap nav bat-->

<div class="container-fluid" id="banner">
  <div class="row" >
   <img class="img img-responsive  " src ="{{ '/images/pages/illus.png' }}"  height="60px"></img>
  </div>
 </div>

<div class="nav-wrapper">
<nav class="navbar navbar-default navbar-static" >
	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Be The Lemon</a>
		</div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="{{ Request::is('/') ? "active" : "" }}"><a href="/">Home <span class="sr-only">(current)</span></a></li>
			<li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about">About</a></li>
			<li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact">Contact</a></li>
			@foreach($pages as $page)
			<?php $i=0;  ?>
				@foreach($categories as $category)
					@if($category->page->id == $page->id)
					<?php $i++;?>
					@endif
				@endforeach
				@if($i > 0)
				<li class="dropdown {{ Request::is($page->url.'/*') ? "active" : "" }}">
					<a href="{{ $page->url }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ $page->name }}<span class="caret"></span>
					</a>
					<ul class="dropdown-menu " role="menu">
						@foreach($categories as $cat)
							@if($cat->page->id == $page->id)
							<li class="{{ Request::is($page->url.'/'.$cat->name)||Request::is($page->url.'/'.$cat->name.'/*') ? "active" : "" }}"><a href="{{ url($page->url.'/'.$cat->name) }}">{{ $cat->name }}</a></li>
							@endif
						@endforeach
					</ul>
				</li>
				@else<li class="{{ Request::is($page->url)||Request::is($page->url.'/*') ? "active" : "" }}"><a href="{{ url($page->url) }}">{{ $page->name }}</a></li>
				@endif
			@endforeach
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
         <!-- Authentication Links -->
			@if (Auth::guest())
                        
            @else
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
					<li><a href="{{ route('posts.index') }}">Posts</a></li>
					<li><a href="{{ route('categories.index') }}">Categories</a></li>
					<li><a href="{{ route('pages.index') }}">Pages</a></li>						
					<li role="separator" class="divider"></li>
					<li>
						<a href="{{ url('/logout') }}"
							onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>
						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
						</form>
                    </li>
				</ul>
            </li>
            @endif
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
