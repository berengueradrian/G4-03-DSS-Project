<form action="{{ route('collection.store') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Collection name" aria-label="Name" aria-describedby="basic-addon1" id="name">
    </div>
    @if ($errors->has("name"))
        @foreach ($errors->get('name') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-textarea">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Description</span>
        </div>
        <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description of the collection" aria-label="Description" aria-describedby="basic-addon2" id="description">
    </div>
    @if ($errors->has('description'))
        @foreach ($errors->get('description') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Artist</span>
        </div>
        <input type="number" class="form-control" name="artist_id" placeholder="ID of the artist which is the owner" value="{{ old('artist_id') }}" aria-label="Username" aria-describedby="basic-addon3" id="artist_id">
    </div>
    @if ($errors->has('artist_id'))
        @foreach ($errors->get('artist_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="number" class="form-control" name="img_url" placeholder="ID of the artist which is the owner" value="{{ old('img_url') }}" aria-label="Username" aria-describedby="basic-addon3" id="img_url">
    </div>
    @if ($errors->has('img_url'))
        @foreach ($errors->get('img_url') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button class="btn btn-primary">Create</button>
</form>

<style lang="scss">
.create-collection-container{
    margin-top: 1rem;
}

.bootstrap-textarea{
    width: 600px;
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