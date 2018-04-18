@extends('main')
@section('title','| All Posts')
@section('content')


<div class="row">
	<div class="col-md-10">
		<h1>All Posts</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Titre</th>
					<th>Contenu</th>
					<th>Créer le</th>
					<th>Publié</th>
					<th></th>
					
					
				</tr>
			</thead>
			<tbody>
				<?php $i=1;?>
				@foreach($posts as $post)
				
				<tr>
					<th scope="row">{{ $i }}</th>
						<td>{{ $post->title }}</td>
						<td>{!! substr($post->body,0,50) !!}{{ strlen($post->body) > 50 ? "..." :"" }}</td>
						<td>{{ date('j M Y :H \h m', strtotime($post->created_at)) }}</td>
						<td>{{ ($post->published == true ? 'Oui' : 'Non') .($post->featured == true ? '  et épinglé' : '') }}</td>
						<td>{!! Html::linkRoute('posts.show', '', [$post->id], ['class'=> 'btn btn-success btn-sm glyphicon glyphicon-eye-open']) !!}
						{!! Html::linkRoute('posts.edit', '', [$post->id], ['class'=> 'btn btn-primary btn-sm glyphicon glyphicon-pencil']) !!}
						</td>
				</tr>
				<?php $i++;?>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-2">
		<a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary" style="margin-top:10px">Créer un nouveau Post</a>
	</div>
	<hr>
	
</div>

@endsection
