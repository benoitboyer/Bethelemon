@extends('main')
@section('title', '| Edit Comment')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2"><h1>Edit Comment</h1>
	
			{{ Form::model($comment, ['route'=>['comments.update', $comment->id], 'method' =>'PUT']) }}
				{{ Form::label('author', 'Name:') }}
				{{ Form::text('author', null,['class'=>'form-control', 'disabled'=>'']) }}
		
				{{ Form::label('email', 'Email:') }}
				{{ Form::text('email', null,['class'=>'form-control', 'disabled'=>'']) }}
			
				{{ Form::label('body', 'Comment:') }}
				{{ Form::textarea('body', null,['class'=>'form-control']) }}
		
				{{ Form::submit('Update Comment', ['class'=>'btn btn-success btn-block form-spacing-top']) }}
		
			{{ Form::close() }}
		</div>
	</div>

@endsection
