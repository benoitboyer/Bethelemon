@extends('main')
@section('title','| Voir les Pages')
@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Pages</h1>
			<table class="table">
				<thead>
					<tr>
						<th># </th>
						<th>Nom:</th>
						<th>URL:</th>
						<th>Créer le:</th>
						<th>Nb Categories:</th>
						
						<th></th>
					</tr>		
				</thead>
				<tbody>
					@foreach($pages as $page)
					<tr>	
						<th>{{ $page->id }}</th>
						<td>{{ $page->name }}</td>
						<td>{{ $page->url }}</td>
						<td>{{ date('d M Y : H\hm',strtotime($page->page_created_at)) }}</td>
						<?php $i=0; ?>
						@foreach($categories as $category)
							<?php if ($category->page_id == $page->id){ $i++;}?>
						@endforeach
						<td>{{ $i }}</td>
						<th>
							{!! Form::open(['route'=>['pages.destroy',$page->id], 'method' => 'DELETE',]) !!}
							{!! Form::submit('Supprimer', ['class'=>'btn btn-danger btn-xs btn-block']) !!}
							{!! Form::close() !!}
						</th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-3">
			<div class="well">
				{{ Form::open(['route' => 'pages.store','files'=>'true']) }}
					<h2>New Page</h2>
					{{ form::label('name', 'Nom:') }}
					{{ form::text('name', null,['class' => 'form-control']) }}
					
					{{ form::label('url', 'URL:') }}
					{{ form::text('url', null,['class' => 'form-control']) }}
					
					{{ Form::label('featured_image', 'Upload Featured Image:') }}
					{{ Form::file('featured_image') }}
					
					<br>
					{{ Form::submit('Créer une nouvelle page', ['class'=>'btn btn-sucess btn-primary btn-block']) }}
				
				{{ Form::close() }}
			</div>
		</div>
	</div>
	

@endsection
