@extends('main')
@section('title' ,'| Test')

@section('content')
<p>This is Hello World by HTML</p>
<div id="msgid">
</div>

@endsection
@section('scripts')
	{!! Html::script('js/script.js') !!}
@endsection
