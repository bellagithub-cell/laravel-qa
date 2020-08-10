@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        {{-- kelas d-flex ini  buat the content of both sides in the same base line --}}
                        <h2>ALL Questions</h2>
                        <div class="ml-auto">
                            {{-- will be positioned in the right --}}
                            <a href="{{ route('questions.create') }}"  class="btn btn-outline-secondary">Ask Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts._messages')
                    
                    @foreach($questions as $question)
                        <div class="media">
                            {{-- buat bikin votes --}}
                            <div class="d-felx flex-column counters">
                                <div class="vote">
                                <strong>{{ $question->votes }}</strong>
                                {{ Str::plural('vote', $question->votes) }}
                                </div>
                                <div class="status {{ $question->status }} ">
                                    <strong>{{ $question->answers }}</strong>
                                    {{ Str::plural('answers', $question->answers) }}
                                </div>
                                <div class="view">
                                    {{ $question->views . " " . Str::plural('view', $question->views) }}
                                </div>
                            </div>  
                            <div class="media-body">
                                {{-- buat class div button edit dan judul --}}
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0">
                                    <a href="{{ $question->url }}">
                                        {{ $question->title }}
                                    </a>
                                    </h3>
                                    <div class="ml-auto">
                                        <a href="{{ route('questions.edit', $question->id ) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        <form class="form-delete" action="{{ route('questions.destroy', $question->id)}}" method="POST">
                                            {{-- {{  method_field('DELETE') }} --}}
                                            {{-- bisa pakai yg atas, bisa pakai yg bawah --}}
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <p class="lead">
                                    Asked by 
                                    <a href="{{ $question->user->url }} ">
                                        {{ $question->user->name }}
                                    </a>

                                    {{-- buat creation date --}}
                                    <small class="text-muted">
                                        {{ $question->created_date }}
                                    </small>
                                </p>
                                {{ Str::limit($question->body, 250) }}
                            </div>
                        </div>

                        <hr>
                    @endforeach
                    <div class="mx-auto">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
