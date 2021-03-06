@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        {{-- kelas d-flex ini  buat the content of both sides in the same base line --}}
                        <h2>Ask Questions</h2>
                        <div class="ml-auto">
                            {{-- will be positioned in the right --}}
                            <a href="{{ route('questions.index') }}"  class="btn btn-outline-secondary">Back to all Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   {{-- Question Form --}}
                <form action="{{  route('questions.store') }}" method="post">
                    {{-- // di pindahin ke _form.blade buat hemat code dan praktis --}}
                    {{-- tapi harus nambahin include disni --}}
                    @include ('questions._form', ['buttonText' => "Ask Question"])
                    {{-- disini kirim data juga yg berupa array isinya buttonText itu --}}
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
