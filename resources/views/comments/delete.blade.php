@extends('main')
@section('title', '| Delete Comment?')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2"><h1>Edit Comment</h1>
			<h1>DELETE THIS COMMENT?</h1>
			<p>
				<strong>Name:</strong>{{ $comment->author }}<br>
				<strong>Email:</strong>{{ $comment->email }}<br>
				<strong>Comment:</strong>{{ $comment->body }}				
			</p>
			{{ Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'DELETE']) }}
				{{ Form::submit('YES DELETE THIS COMMENT', ['class'=>'btn btnblock btn-lg btn-danger']) }}
			{{ Form::close() }}
		</div>
	</div>

@endsection
