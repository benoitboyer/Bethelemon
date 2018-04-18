@extends('main')
@section('title','| View Post')
@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>{{ $post->title }}</h1>
		<p class="lead">{!! $post->body !!}</p>
	</div>
	<div class="col-md-4 well">
		<dl class="dl-horizontal">
			<dt>Créé le:</dt>
			<dd>{{ $post->created_at }}</dd>
		</dl>
		<dl class="dl-horizontal">
			<dt>Modifié le:</dt>
			<dd>{{ $post->updated_at }}</dd>
		</dl>
		<div class="row">
			<div class="col-sm-6">			
				{!! Html::linkRoute('posts.edit', 'Modifier', [$post->id], ['class'=> 'btn btn-primary btn-block']) !!}
			</div>
			<div class="col-sm-6">
				{!! Form::open(['route'=>['posts.destroy',$post->id], 'method' => 'DELETE',]) !!}
				{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-8 col">
		<table class="table">
			<thead>
				<tr>
				<th>Auteur</th>
				<th>Email</th>
				<th>Commentaire</th>
				<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($post->comments as $comment)
				<tr>
					<td>{{ $comment->author }}</td>
					<td>{{ $comment->email }}</td>
					<td >{{ $comment->body }}</td>
					<td>
					<a href="{{ route('comments.edit',$comment->id)}}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="{{ route('comments.delete',$comment->id)}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>


@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
