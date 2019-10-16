@extends('layouts.store')

@section('content')
<nav class="w-full bg-red-700 py-4 mb-6">
	<div class="max-w-5xl mx-auto flex items-center justify-between">
	<a href="{{env('CLA_URL', 'https://cla.mustincrease.com')}}"><img src="/images/logo.png" alt="" class="h-8"></a>
		<ul class="links text-white uppercase tracking-wide">
			<a href="{{env('CLA_URL', 'https://cla.mustincrease.com')}}" class="hover:opacity-75">Return to Site</a>
		</ul>
	</div>
</nav>

@endsection