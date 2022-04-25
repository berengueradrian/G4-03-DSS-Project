<form action="{{ route('type.update') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    @method('PUT')

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="number" class="form-control" name="id_update" value="{{ old('id_update') }}" placeholder="Identifier of the type" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
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
        <input type="text" class="form-control" name="name_update" value="{{ old('name_update') }}" placeholder="New type name (optional)" aria-label="Name" aria-describedby="basic-addon1" id="name_update">
    </div>
    @if ($errors->has('name_update'))
        @foreach ($errors->get('name_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Exclusivity</span>
      </div>
      <input type="text" class="form-control" name="exclusivity_update" value="{{ old('exclusivity_update') }}" placeholder="New exclusivity (optional)" aria-label="Exclusivity" aria-describedby="basic-addon1" id="exclusivity_update">
    </div>
    @if ($errors->has('exclusivity_update'))
        @foreach ($errors->get('exclusivity_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-textarea">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Description</span>
        </div>
        <input type="text" class="form-control" name="description_update" value="{{ old('description_update') }}" placeholder="New description of the type (optional)" aria-label="Description" aria-describedby="basic-addon2" id="description_update">
    </div>
    @if ($errors->has('description_update'))
        @foreach ($errors->get('description_update') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif

    <button type="submit" class="btn btn-primary">Update</button>
</form>