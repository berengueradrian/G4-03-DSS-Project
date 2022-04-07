<form action="{{ route('artist.delete') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    @method('DELETE')
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon10">ID</span>
        </div>
        <input type="text" class="form-control" name="iddelete" value="{{ old('iddelete') }}" placeholder="Identifier of the artist" aria-label="iddelete" aria-describedby="basic-addon10" id="iddelete">
    </div>
    @if ($errors->has('iddelete'))
        @foreach ($errors->get('iddelete') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    @if ($withCollection)
    <div class="invalid-tooltip mb-3">An artist with collections cannot be deleted</div>
    @endif
    <button type="submit" class="btn btn-primary">Delete</button>
</form>