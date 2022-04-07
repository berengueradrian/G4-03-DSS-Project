<form action="{{ route('type.store') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Type name" aria-label="Name" aria-describedby="basic-addon1" id="name">
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
        <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description of the type" aria-label="Description" aria-describedby="basic-addon2" id="description">
    </div>
    @if ($errors->has('description'))
        @foreach ($errors->get('description') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button class="btn btn-primary">Create</button>
</form>


<style>
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