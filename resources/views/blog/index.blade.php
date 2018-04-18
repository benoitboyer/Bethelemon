@extends('main')
@section('title', '| Blog')
@section('content')

	<div class="row">
		<div class="col-md-9 ">
			@if($section!= null)
			<div class="row ">				
					<div class=" banner">
						<img class="img img-responsive" src ="{{ '/images/'.$section}}" width="100%" height="auto"></img>
					</div>
					<br>
			</div>
			@endif
	
			<div class="post row  masonry-container">
					
						<?php 
						$i=0;
						$count=count($posts);
						?>
						@foreach($posts as $post)
						
						@if($i%2 ==0)
						<div class="row post-masonry ">
						@endif
							<div class="col-md-6 item white-panel">	
							@if($post->featured_image != '')
								<div class="post_image">
									<img src="{{ '/images/'.$post->featured_image }}" class="img-responsive" width = "100%" height ="auto" alt="Smiley face"> 
								</div>
							
							@endif				
								<div class="post_title"><h4>{{ $post->title }}</h4></div>
								<div class="post_date"><h5>Published: {{ date('j M o G:i:s', strtotime($post->created_at)) }}</h5></div>
								<div class="post_body"><p>{{ mb_substr(strip_tags($post->body), 0, 100,'UTF-8') }} {{ strlen(strip_tags($post->body))>100 ? "..." : "" }}</p></div>
								@if($post->category_id != null)
								<div class="post_link text-right">
									<a href="{{url( $post->page->url.'/'.$post->category->name.'/'.$post->slug)}}" class="btn btn-default">Lire la suite ...</a>
								</div>
								@else
								<div class="post_link text-right">
									<a href="{{url( $post->page->url.'/'.$post->slug)}}" class="btn btn-default">Lire la suite ...</a>
								</div>
								@endif
							
							</div>
							
						@if($i%2!=0 ||$i+1==$count)
						</div>
						@endif
							<?php $i++;?>
						@endforeach
					</div>				
		</div>
		@include('partials.side_content')
	</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>


<script>
jQuery(window).on('load', function() { 

	var $ = jQuery;
	var $container = $('.masonry-container');

 
	$container.imagesLoaded( function () {
	 
		var $widthItem= $('.item').outerWidth();
		$widthItem-=20;
		$('.item').css("width", $widthItem);
	 
	 	$container.masonry({
	   		columnWidth: '.item',
	   		columnHeight: '.item',
	   		itemSelector: '.item',
			gutter: 10
		});
 	});

	$(window).resize(function () {

		var $width = $(window).width();
	    if($width >= 1200) {        
			$('.item').css("width", "434px");
		 	$container.masonry({
		   		columnWidth: '.item',
		   		columnHeight: '.item',
		   		itemSelector: '.item',
				gutter: 10
		 	});	
		}

    	if($width < 980 && $width >= 768) {

			$('.item').css("width", "750px");				   						   
			$container.imagesLoaded( function () {
				$container.masonry({
					columnWidth: '.item',
					columnHeight: '.item',
					itemSelector: '.item',	
				});
			});
		}
		else if($width < 1200 && $width >= 980) {
              
			$('.item').css("width", "358px");
			$container.masonry({
				columnWidth: '.item',
			   	columnHeight: '.item',
			   	itemSelector: '.item',
				gutter: 10
			});
		}
	});   
});
</script>
	{!! Html::script('js/script.js') !!}
@endsection
		
		
		
