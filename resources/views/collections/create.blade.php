<form action="{{ route('collection.store') }}" method="POST" class="needs-validation create-collection-container">
    @csrf
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">@</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Collection name" aria-label="Name" aria-describedby="basic-addon1" id="name">
    </div>
    @if ($errors->has('name'))
        <ul>
            @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">With description</span>
        </div>
        <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Collection name" aria-label="Description" aria-describedby="basic-addon2" id="description">
    </div>
    @if ($errors->has('description'))
        <ul>
            @foreach ($errors->get('description') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">#</span>
        </div>
        <input type="text" class="form-control" name="artist_id" placeholder="Owner artist" value="{{ old('artist_id') }}" aria-label="Username" aria-describedby="basic-addon3" id="artist_id">
    </div>
    @if ($errors->has('artist_id'))
        <ul>
            @foreach ($errors->get('artist_id') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <button type="submit" class="btn btn-primary">Create</button>
</form>

<style lang="scss">
.create-collection-container{
    margin-top: 1rem;
}

.bootstrap-textarea{
    margin-bottom: 1rem !important;
    width: 600px;
}

.bootstrap-input{
    width: 400px;
}

button{
    margin-bottom: 1rem;
}
</style>

<script>
    export default{
        data(){

        }
    }
</script>