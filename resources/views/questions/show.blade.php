@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{ $question->title }}</h1>
                        <div class="ml-auto">
                            {{-- will be positioned in the right --}}
                            <a href="{{ route('questions.index') }}"  class="btn btn-outline-secondary">Back to all Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- karena question body is in markdown syntax --}}
                    {{-- jadi kita buat a new accessor where encapsulates the markdown to html conversion. --}}
                  {!!  $question->body_html !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
