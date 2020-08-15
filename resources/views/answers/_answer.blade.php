<div class="media post">
    @include ('shared._vote',[
        'model' => $answer
    ])
    
    <div class="media-body">
        {!! $answer->body_html !!}

        <div class="row">
            <div class="col-4">
                <div class="ml-auto">
                    {{-- auth user supaya button edit gk muncul --}}
                    {{-- bisa juga pakai ini --}}
                    @can('update', $answer)
                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                    @endcan

                    {{-- bisa pakai ini untuk auth --}}
                    {{-- @if(Auth::user()->can('delete', $question)) --}}
                    @can('delete', $answer)
                        <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id])}}" method="POST">
                            {{-- {{  method_field('DELETE') }} --}}
                            {{-- bisa pakai yg atas, bisa pakai yg bawah --}}
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endcan
                </div>
              </div>
            <div class="col-4">
            </div>
            {{-- add other info and creation date --}}
            <div class="col-4">
                {{-- pindah ke _author.blade --}}
                @include('shared._author', [
                    'model' => $answer,
                    'label' => 'answered'
                ])
            </div>
        </div>

        
    </div>
</div>