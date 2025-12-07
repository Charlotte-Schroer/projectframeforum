@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                Welcome at FrameForum! 🎬
            </h1>
            <p class="text-gray-600">
                The place to be for anything Movie related.
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('news.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                    Go To News
                </a>
                <a href="{{ route('forum.index') }}" class="bg-white text-indigo-600 border border-indigo-600 px-6 py-3 rounded-md hover:bg-indigo-50">
                    Go To Forum
                </a>
            </div>
        </div>
    </div>
@endsection
