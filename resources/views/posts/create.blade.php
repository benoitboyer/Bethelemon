@extends('main')
@section('title' ,'| Create Post')
@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "autolink lists link image hr",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
	
  tinymce.init(editor_config);

</script>
@endsection
@section('content')
	
	<div class="row">
		<div class="col-md-8 col-offset-2">
			<h1>Create New Post</h1>
			
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate'=>'','files'=>'true']) !!}
			
				{{ Form::label('title', 'Titre:') }}
				{{ Form::text('title',null, ['class' =>'form-control','required'=>'','maxlength'=>'255']) }}
				
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug',null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength'=> '255', 'pattern' =>"^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$"))}}
				
				{{ Form::label('page_id', 'Pour la Page:') }}
						<select class="form-control" name="page_id" required=''>
							<option value="" selected="selected"></option>
							@foreach($pages as $page)
								
								<option value='{{ $page->id }}'>{{ $page->name }}</option>
								
							@endforeach
				
						</select>
				<br>
				
				{{ Form::label('category_id', 'Pour la Categorie:') }}
						<select class="form-control" name="category_id">
							<option value="" selected="selected"></option>
							@foreach($categories as $category)
								
								<option value='{{ $category->id }}'>{{ $category->name }}</option>
								
							@endforeach
				
						</select>
				<br>
				{{ Form::label('body', 'Body:') }}
				{{ Form::textarea('body',null,['class'=>'form-control my-editor']) }}
				
				{{ Form::label('featured_image', 'Upload Featured Image:') }}
				{{ Form::file('featured_image') }}
				
				{{ Form::label('featured', 'Featured:') }}
				{{ Form::hidden('featured',0)}}
				{{ Form::checkbox('featured',true) }}
				{{ Form::label('published', 'Publier:') }}
				{{ Form::hidden('published',0)}}
				{{ Form::checkbox('published', true) }}
				
				{{ Form::submit('Create the New Post', ['class'=>'btn btn-success btn-lg btn-block']) }}
			
			
			
			
			{!! Form::close() !!}
			
		</div>
	</div>



@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@endsection
