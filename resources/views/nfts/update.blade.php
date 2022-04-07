<form action="{{ route('nft.update') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    @method('PUT')
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="number" class="form-control" name="id_update" value="{{ old('id_update') }}" placeholder="Identifier of the NFT" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
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
        <input type="text" class="form-control" name="name_update" value="{{ old('name_update') }}" placeholder="New NFT name (optional)" aria-label="name_update" aria-describedby="basic-addon1" id="name_update">
    </div>
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Base price</span>
        </div>
        <input type="text" class="form-control" name="base_price_update" value="{{ old('base_price_update') }}" placeholder="New base price of the collection (optional)" aria-label="base_price_update" aria-describedby="basic-addon2" id="base_price_update">
    </div>
    @if ($errors->has('base_price_update'))
        @foreach ($errors->get('base_price_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Limit date</span>
        </div>
        <input type="date" class="form-control" name="limit_date" placeholder="yyyy/mm/dd (optional)" value="{{ old('limit_date') }}" aria-label="Username" aria-describedby="basic-addon3" id="limit_date">
    </div>
    @if ($errors->has('limit_date'))
        @foreach ($errors->get('limit_date') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Collection</span>
        </div>
        <input type="number" class="form-control" name="collection_id_update" placeholder="New belonging collection (optional)" value="{{ old('collection_id_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="collection_id_update">
    </div>
    @if ($errors->has('collection_id_update'))
        @foreach ($errors->get('collection_id_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">User</span>
        </div>
        <input type="number" class="form-control" name="user_id_update" placeholder="New user owner (optional)" value="{{ old('user_id_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="user_id_update">
    </div>
    @if ($errors->has('user_id_update'))
        @foreach ($errors->get('user_id_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Type</span>
        </div>
        <input type="number" class="form-control" name="type_id_update" placeholder="New type (optional)" value="{{ old('type_id_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="type_id_update">
    </div>
    @if ($errors->has('type_id_update'))
        @foreach ($errors->get('type_id_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="text" class="form-control" name="img_url_update" placeholder="New associated image (optional)" value="{{ old('img_url_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="img_url_update">
    </div>
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Availability</span>
        </div>
        <input type="number" class="form-control" name="availability_update" placeholder="New status (optional)" value="{{ old('availability_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="availability_update">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
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