@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                {{-- will be positioned in the right --}}
                                <a href="{{ route('questions.index') }}"  class="btn btn-outline-secondary">Back to all Questions</a>
                            </div>
                        </div>
                    </div>

                    <hr>
    
                    <div class="media">
                        {{-- pindah ke view lain --}}
                        {{-- @include('shared._vote', [
                            'model' => $question
                        ]) --}}
                        <vote :model="{{ $question }}" name="question"></vote>
                       <div class="media-body">
                            {{-- karena question body is in markdown syntax --}}
                            {{-- jadi kita buat a new accessor where encapsulates the markdown to html conversion. --}}
                        {!!  $question->body_html !!}
    
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    {{-- @include('shared._author', [
                                        'model'=>  $question,
                                        'label' => 'asked'
                                    ]) --}}

                                    {{-- call userinfo component --}}
                                    <user-info :model="{{ $question }}" label="Asked"></user-info>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- bagian answersnya dipindah 
    @include ('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ]) --}}

    {{-- view baru create answer --}}
    <answers :question="{{ $question }}"></answers>
    
    {{-- @include ('answers._create') --}}
</div>
@endsection
