<form action="{{ route('artist.store') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Artist user name" aria-label="Name" aria-describedby="basic-addon1" id="name">
    </div>
    @if ($errors->has('name'))
        @foreach ($errors->get('name') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Balance</span>
        </div>
        <input type="text" class="form-control" name="balance" value="{{ old('balance') }}" placeholder="Artists balance" aria-label="Name" aria-describedby="basic-addon1" id="balance">
    </div>
    @if ($errors->has('balance'))
        @foreach ($errors->get('balance') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="text" class="form-control" name="img_url" value="{{ old('img_url') }}" placeholder="Profile image" aria-label="Name" aria-describedby="basic-addon1" id="img_url">
    </div>
    @if ($errors->has('img_url'))
        @foreach ($errors->get('img_url') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Description</span>
        </div>
        <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description of the artist" aria-label="Name" aria-describedby="basic-addon1" id="description">
    </div>
    @if ($errors->has('description'))
        @foreach ($errors->get('description') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button class="btn btn-primary">Create</button>
</form>


<style lang="scss">
.btn{
    margin-bottom: 1rem !important;
}
.bootstrap-input{
    width: 400px;
}

.invalid-tooltip{
    position: relative;
    display: block;
    width: 400px;
    margin-top: -15px;
}
</style>