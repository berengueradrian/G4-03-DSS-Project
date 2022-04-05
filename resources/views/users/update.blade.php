<form action="{{ route('users.update') }}" method="POST" class="needs-validation create-user-container">
    @csrf
    @method('PUT')


    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="text" class="form-control" name="id" value="{{ old('id') }}" placeholder="Identifier of the user" aria-label="id" aria-describedby="basic-addon1" id="id">
    </div>
    @if ($errors->has('id'))
    @foreach ($errors->get('id') as $error)
    <div class="invalid-tooltip mb-3">{{ $error }}</div>
    @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
        </div>
        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="New email of the user (optional)" aria-label="email" aria-describedby="basic-addon2" id="email">
    </div>
    @if ($errors->has('email'))
    @foreach ($errors->get('email') as $error)
    <div class="invalid-tooltip mb-3">{{ $error }}</div>
    @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Balance</span>
        </div>
        <input type="text" class="form-control" name="balance" placeholder="New owner artist ID (optional)" value="{{ old('balance') }}" aria-label="Username" aria-describedby="basic-addon3" id="balance">
    </div>
    @if ($errors->has('balance'))
    @foreach ($errors->get('balance') as $error)
    <div class="invalid-tooltip mb-3">{{ $error }}</div>
    @endforeach
    @endif
    <button type="submit" class="btn btn-primary">Update</button>
</form>



<style lang="scss">
    .create-user-container {
        margin-top: 1rem;
    }

    .bootstrap-textarea {
        width: 600px;
    }

    .bootstrap-input {
        width: 400px;
    }

    button {
        margin-bottom: 1rem;
    }

    .invalid-tooltip {
        position: relative;
        display: block;
        width: 400px;
        margin-top: -15px;
    }
</style>