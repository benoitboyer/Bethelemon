@extends('main')
<?php $titleTag = htmlspecialchars($post->title);?>
@section('title', "| $titleTag")
@section('content')


<div class="container">
	<div class="col-md-9">	
		<div class="row">
			
				<div class="post">
					<h2>{{ $post->title }}</h2>					
					<h5>Published: {{ date('j M o G:i:s', strtotime($post->created_at)) }}</h5>
					@if($post->featured_image != '')
					<div class="post-img">	
						 <img src="{{ '/images/'.$post->featured_image }}" width = "100%" alt="Smiley face" > 
					</div>
					@endif
					<div class="post-body">
						{!! $post->body !!}
					</div>	
				</div>
				<hr>
				<br>
				<div class="col-md-12">
					<div class="share share-panel">
						<div class="col-md-6 text-left share-text">
							<h4>Partagez sur vos résaux sociaux</h4>
						</div>
						<div class="col-md-6 text-right share-icons">
						<a class="fb" href="#"><i class="fa fa-facebook fa-2x"></i></a>
						<a class="twit" href="#"><i class="fa fa-twitter fa-2x"></i></a>
						<a class="pint" href="#"><i class="fa fa-pinterest fa-2x"></i></a>
						<a class="insta" href="#"><i class="fa fa-instagram fa-2x"></i></a>
						</div>
					</div>
					
					  <div class="clearfix">
						
					  </div>
					
				</div>
			
		</div>
		<div class="row">
			
				<h3 class="comment-title"><span><img src="/images/com.png" width="8%"></img </span>{{ " ".$post->comments->count() }} Commentaires</h3>
				@foreach($post->comments as $comment)
					<div class="comment">
					
						<div class="author-info">
							<div class="author-image"><img src="https://www.gravatar.com/avatar/{{ md5($comment->email).'?d=retro' }}"></div>
							<div class="author-name">
								<h4>{{ $comment->author }}</h4>
							</div>
							<p class="author-time">
								{{ $comment->created_at}}
							</p>
							
						</div>
						<div class="comment-content">
							{{ $comment->body }}
						</div>
					</div>
				@endforeach
			
		</div>
		<div class="new-comment">
			<span class="btn  btn-default">Ajouter un commentaire</span>
		</div>
		
		<div class="row ">
			
			<div id="comment-form " class="col-md-12 hide comment-form " style="margin-top:20px;">
				{{ Form::open(['route'=>['comments.store',$post->id, 'method'=>'POST']]) }}
				
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user blue"></i></span>
									{{ Form::text('author',null, ['class'=>'form-control']) }}
								</div>
							</div>	
						
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope blue"></i></span>
									{{ Form::email('email',null, ['class'=>'form-control']) }}
								</div>
							</div>	
					
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-comment blue"></i></span>
									{{ Form::textarea('body',null, ['class'=>'form-control','rows'=>'5']) }}
								</div>
							</div>
							{{ Form::submit('Publier le commentaire',['class'=>'btn btn-success btn-block','style'=>'margin-top:15px;']) }} 

				
				{{ Form::close() }}
			
			</div>
		</div>
	</div>
	@include('partials.side_content')
</div>	
@endsection
@section('scripts')
<script>
$(document).ready(function(){
	$('.new-comment').on("click",function(){
		$('.comment-form').toggleClass('hide');
	});
	$('.fb').mouseover(function(){
		 $(this).css();
	});
});
</script>
	{!! Html::script('js/script.js') !!}
@endsection
		

