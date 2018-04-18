@extends('main')
@section('title','| All categories')
@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th># </th>
						<th>Nom:</th>
						<th>Page:</th>
						<th>Créer le:</th>
						<th></th>
					</tr>		
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>	
						<th>{{ $category->id }}</th>
						<td>{{ $category->name }}</td>
						<td>{{ $category->page->name }}</td>
						<td>{{ date('d M Y : H\hm',strtotime($category->created_at)) }}</td>
						<th>
							{!! Form::open(['route'=>['categories.destroy',$category->id], 'method' => 'DELETE',]) !!}
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
				{{ Form::open(['route' => 'categories.store','files'=>'true']) }}
					<h2>New Category</h2>
					{{ form::label('name', 'Name:') }}
					{{ form::text('name', null,['class' => 'form-control']) }}
					{{ Form::label('featured_image', 'Upload Featured Image:') }}
					{{ Form::file('featured_image') }}
					
					
					{{ Form::label('page_id', 'Pour la page:') }}
						<select class="form-control" name="page_id">
					
							@foreach($pages as $page)
								<option value='{{ $page->id }}'>{{ $page->name }}</option>
							@endforeach
				
						</select>
							
					<br>
					
					{{ Form::submit('Create New Category', ['class'=>'btn btn-sucess btn-primary btn-block']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
	

@endsection
