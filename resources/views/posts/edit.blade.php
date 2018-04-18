@extends('main')
@section('title' ,'| Edit Post')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>
	tinymce.init({
		selector: 'textarea',
		plugins : 'link code',
		menubar:false,
		entity_encoding : "raw",
		encoding: "UTF-8"
	});
 </script>
@endsection
@section('content')
	
	<div class="row">
		<div class="col-md-8 col-offset-2">
			<h1>Modifier le Post</h1>
			
			{!! Form::open(['route' => ['posts.update',$post->id],'method'=>'PUT','data-parsley-validate'=>'','files'=>'true']) !!}
			
				{{ Form::label('title', 'Titre:') }}
				{{ Form::text('title',$post->title, ['class' =>'form-control','required'=>'','maxlength'=>'255']) }}
				
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', $post->slug,['class'=>'form-control', 'required'=>'','maxlength'=>'255']) }}
				
				{{ Form::label('page_id', 'Pour la Page:') }}
						<select class="form-control" name="page_id">
							<option value="{{ $post->page_id }}" selected="selected">{{ $post->page->name }}</option>
							@foreach($pages as $page)
								@if($post->page_id != $page->id)
								<option value='{{ $page->id }}'>{{ $page->name }}</option>
								@endif
							@endforeach
				
						</select>
				<br>
				
				{{ Form::label('category_id', 'Pour la Categorie:') }}
						<select class="form-control" name="category_id">
							<option value="" selected="selected"></option>
							@foreach($categories as $category)
								
								@if($category->page_id== $post->page_id)
								<option value='{{ $category->id }}'>{{ $category->name }}</option>
								@endif
							@endforeach
				
						</select>
				<br>
				
				{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body',$post->body,['class'=>'form-control','required'=>'']) }}
				
				{{ Form::label('featured_image', 'Update Featured Image:',['class' =>'form-spacing-top']) }}
				{{ Form::file('featured_image') }}
				
				{{ Form::label('featured', 'Featured:') }}
				{{ Form::hidden('featured',0)}}
				{{ Form::checkbox('featured',true, ($post->featured == 0 ? 0 :1)) }}
				{{ Form::label('published', 'Publier:') }}
				{{ Form::hidden('published',0)}}
				{{ Form::checkbox('published',true, ($post->published == 0 ? 0 :1)) }}
				
					
			
		
			
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Create At:</dt>
					<dd>{{ date('j M o G:i:s', strtotime($post->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Update:</dt>
					<dd>{{ date('j M o G:i:s', strtotime($post->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
						
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Modifier le Post', ['class'=>'btn btn-success btn-block'])}}
						<!--{!! Html::linkRoute('posts.update', 'Save Changes', array($post->id), array('class'=>'btn btn-success btn-block')) !!}
						-->
							{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	


@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
