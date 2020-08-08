{{-- di depan ada _ buat indicate kalau ini partial file --}}


{{-- show the flash message that is stored in session to our view --}}
@if(session ('success'))
    {{-- kalau ada value dengan key sukses maka akan ke sini --}}
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif