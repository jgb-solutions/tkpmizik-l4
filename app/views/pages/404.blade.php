@extends('layout.main')

@section('title')
	{{ $title }}
@stop

@section('content')

<div class="col-sm-8">

	<h1 class="text-center">{{ $title }}</h1>

	<div id="page-content">
		<p class="text-center"><img src="{{ Config::get('site.404img') }}"></p>
		<p>Paj, mizik oubyen videyo ou ap eseye jwenn nan pa egziste sou sit la. Sa ka rive tou ou pa gen dwa pou w aksede ak sa w bezwen an. Tanpri eseye chèche yon mizik oubyen videyo anlè a oubyen tounen sou paj <a href="/">akèy</a> la.</p>
	</div>

</div>

@stop