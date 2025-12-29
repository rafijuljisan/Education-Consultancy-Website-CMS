@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-8">Compare Countries</h1>
    
    <div class="grid md:grid-cols-{{ $countries->count() }} gap-6">
        @foreach($countries as $country)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $country->name }}</h2>
            <!-- Add comparison fields here -->
        </div>
        @endforeach
    </div>
</div>
@endsection