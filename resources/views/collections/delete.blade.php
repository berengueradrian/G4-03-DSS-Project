<form action="{{ route('collection.delete') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    @method('DELETE')
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="text" class="form-control" name="id" value="{{ old('id') }}" placeholder="Identifier of the collection" aria-label="id" aria-describedby="basic-addon1" id="id">
    </div>
    @if ($errors->has('id'))
        @foreach ($errors->get('id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button type="submit" class="btn btn-primary">Delete</button>
</form>

<style lang="scss">
.create-collection-container{
    margin-top: 1rem;
}

.bootstrap-input{
    width: 400px;
}

button{
    margin-bottom: 1rem;
}

.invalid-tooltip{
    position: relative;
    display: block;
    width: 400px;
    margin-top: -15px;
}
</style>