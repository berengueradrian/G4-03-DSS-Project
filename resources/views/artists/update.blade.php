<form action="{{ route('artist.update') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    @method('PUT')

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="number" class="form-control" name="id_update" value="{{ old('id_update') }}" placeholder="Identifier of the artist" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
    </div>
    @if ($errors->has('id_update'))
        @foreach ($errors->get('id_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name_update" value="{{ old('name_update') }}" placeholder="New artist name (optional)" aria-label="Name" aria-describedby="basic-addon1" id="name_update">
    </div>
    @if ($errors->has('name_update'))
        @foreach ($errors->get('name_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Description</span>
        </div>
        <input type="text" class="form-control" name="description_update" value="{{ old('description_update') }}" placeholder="New description (optional)" aria-label="Name" aria-describedby="basic-addon1" id="description_update">
    </div>

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Balance</span>
        </div>
        <input type="text" class="form-control" name="balance_update" value="{{ old('balance_update') }}" placeholder="New balance (optional)" aria-label="Name" aria-describedby="basic-addon1" id="balance_update">
    </div>
    @if ($errors->has('balance_update'))
        @foreach ($errors->get('balance_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Volume sold</span>
        </div>
        <input type="text" class="form-control" name="volume_sold_update" value="{{ old('volume_sold_update') }}" placeholder="New collection name (optional)" aria-label="Name" aria-describedby="basic-addon1" id="volume_sold_update">
    </div>
    @if ($errors->has('volume_sold_update'))
        @foreach ($errors->get('volume_sold_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="text" class="form-control" name="img_url_update" value="{{ old('img_url_update') }}" placeholder="New collection name (optional)" aria-label="Name" aria-describedby="basic-addon1" id="img_url_update">
    </div>
    @if ($errors->has('img_url_update'))
        @foreach ($errors->get('img_url_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>