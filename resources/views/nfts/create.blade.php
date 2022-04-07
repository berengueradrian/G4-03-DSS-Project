<!--TODO: Limit date must be controlled when the NFT is put on sale.-->
<!--TODO: Availability is put to TRUE when the NFT is put on sale. If not it remains false.-->
<form action="{{ route('nft.store') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="NFT name" aria-label="Name" aria-describedby="basic-addon1" id="name">
    </div>
    @if ($errors->has('name'))
        @foreach ($errors->get('name') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Base price</span>
        </div>
        <input type="number" class="form-control" name="base_price" value="{{ old('base_price') }}" placeholder="Initial price" aria-label="base_price" aria-describedby="basic-addon2" id="base_price">
    </div>
    @if ($errors->has('base_price'))
        @foreach ($errors->get('base_price') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="url" class="form-control" name="img_url" value="{{ old('img_url') }}" placeholder="URL of image" aria-label="img_url" aria-describedby="basic-addon2" id="img_url">
    </div>
    @if ($errors->has('img_url'))
        @foreach ($errors->get('img_url') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Collection ID</span>
        </div>
        <input type="number" class="form-control" name="collection_id" value="{{ old('collection_id') }}" placeholder="Id of the collection" aria-label="collection_id" aria-describedby="basic-addon2" id="collection_id">
    </div>
    @if ($errors->has('collection_id'))
        @foreach ($errors->get('collection_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Type ID</span>
        </div>
        <input type="number" class="form-control" name="type_id" value="{{ old('type_id') }}" placeholder="Id of the type" aria-label="type_id" aria-describedby="basic-addon2" id="type_id">
    </div>
    @if ($errors->has('type_id'))
        @foreach ($errors->get('type_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">User ID</span>
        </div>
        <input type="number" class="form-control" name="user_id" value="{{ old('user_id') }}" placeholder="Id of owner user (optional)" aria-label="user_id" aria-describedby="basic-addon2" id="user_id">
    </div>
    @if ($errors->has('user_id'))
        @foreach ($errors->get('user_id') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button class="btn btn-primary">Create</button>
    
</form>