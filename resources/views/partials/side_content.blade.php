<div class="col-md-3  bordure-left">
	<div class="col-md-12">	
		<h2>A propos</h2>
		<p>Be the lemon est un blog généraliste sur notre vision du monde.</p>
		<h2>Nos Résaux sociaux</h2>
		<div class="row">
			<div class="social text-left">
				<ul>
					<li><a href="#"><i class="fa fa-lg fa-facebook img-responsive"></i></a></li>
					<li><a href="#"><i class="fa fa-lg fa-twitter img-responsive"></i></a></li>
					<li><a href="#"><i class="fa fa-lg fa-pinterest img-responsive"></i></a></li>
					<li><a href="#"><i class="fa fa-lg fa-instagram img-responsive"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 visible-md visible-lg">
				<h2>Twiter Feed</h2>
				<a class="twitter-timeline" href="https://twitter.com/ThelemonPoint">Tweets Liked by @TwitterDev</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</div>
		<h3><b>Les articles les plus populaires</b></h3>
		<div class="row">
		@foreach($posts as $post)
			@if($post->featured == 1)
				@if($post->featured_image != '')
					<div class="featured-post col-md-5 col-xs-5">			
						@if($post->category_id != null)
							<div class="featured-img">
								<a href="{{url( $post->page->url.'/'.$post->category->name.'/'.$post->slug)}}" ><img src="{{ '/images/'.$post->featured_image }}" class="img-responsive" width = "100%" height ="auto" alt="Smiley face"> </a>	
							</div>
						@else
							<div class="featured-img">
								<a href="{{url( $post->page->url.'/'.$post->slug)}}" ><img src="{{ '/images/'.$post->featured_image }}" class="img-responsive" width = "100%" height ="auto" alt="Smiley face"> </a>	
							</div>	
						@endif
					</div>
					<div class="col-md-7 col-xs-7 feat-title">
				@endif
				@if($post->category_id != null)
						<div class="featured-title">
							<a href="{{url( $post->page->url.'/'.$post->category->name.'/'.$post->slug)}}" ><h5>{{ $post->title }}</h5></a>	
						</div>
				@else
						<div class="featured-title">
							<a href="{{url( $post->page->url.'/'.$post->slug)}}" ><h5>{{ $post->title }}</h5></a>	
						</div>	
				@endif
						<div class="featured-body">
							{{ mb_substr(strip_tags($post->body), 0, 50,'UTF-8') }} {{ strlen(strip_tags($post->body))>50 ? "..." : "" }}
						</div>
					</div>
				<div class="row">
					<div class="col-md-8  col-md-offset-2">
						<hr>
					</div>
				</div>
			@endif
		@endforeach
		</div>	
		<div class="row">
			<div class="span12">
				<div class=" well text-center newsletter">
					<h2>Newsletter</h2>			
					<p>Abonnez vous pour rester informer!</p>
					<form action="" method="post">
						<div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span>
							<input type="text" id="" name="" placeholder="votreEmail@email.com">
						</div>
						<input type="submit" value="Vous Abonner" class="btn btn-success btn-large follow" />
					</form>
				</div>    
			</div>
		</div>
	</div>
</div>
