<form action="{{ route('user.update') }}" method="POST" class="needs-validation create-user-container">
    @csrf
    @method('PUT')


    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">ID</span>
        </div>
        <input type="number" class="form-control" name="id_update" value="{{ old('id_update') }}" placeholder="Identifier of the user" aria-label="id_update" aria-describedby="basic-addon1" id="id_update">
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
        <input type="text" class="form-control" name="name_update" value="{{ old('name_update') }}" placeholder="New user name" aria-label="Name" aria-describedby="basic-addon1" id="name_update">
    </div>

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Email</span>
        </div>
        <input type="text" class="form-control" name="email_update" value="{{ old('email_update') }}" placeholder="New email of the user (optional)" aria-label="email_update" aria-describedby="basic-addon2" id="email_update">
    </div>
    @if ($errors->has('email_update'))
    @foreach ($errors->get('email_update') as $error)
    <div class="invalid-tooltip mb-3">{{ $error }}</div>
    @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Balance</span>
        </div>
        <input type="text" class="form-control" name="balance_update" placeholder="New balance (optional)" value="{{ old('balance_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="balance_update">
    </div>
    @if ($errors->has('balance_update'))
    @foreach ($errors->get('balance_update') as $error)
    <div class="invalid-tooltip mb-3">{{ $error }}</div>
    @endforeach
    @endif

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Image</span>
        </div>
        <input type="text" class="form-control" name="img_url_update" placeholder="New balance (optional)" value="{{ old('img_url_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="img_url_update">
    </div>

    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Password</span>
        </div>
        <input type="text" class="form-control" name="password_update" placeholder="New balance (optional)" value="{{ old('password_update') }}" aria-label="Username" aria-describedby="basic-addon3" id="password_update">
    </div>
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