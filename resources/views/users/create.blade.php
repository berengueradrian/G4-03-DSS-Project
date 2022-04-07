<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Name</span>
        </div>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="User name" aria-label="Name" aria-describedby="basic-addon1" id="name">
    </div>
    @if ($errors->has('name'))
        @foreach ($errors->get('name') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <div class="input-group mb-3 bootstrap-input">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Email</span>
        </div>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="User email" aria-label="Name" aria-describedby="basic-addon1" id="email">
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
        <input type="text" class="form-control" name="balance" value="{{ old('balance') }}" placeholder="User balance" aria-label="Name" aria-describedby="basic-addon1" id="balance">
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
          <span class="input-group-text" id="basic-addon1">Password</span>
        </div>
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="User password" aria-label="Name" aria-describedby="basic-addon1" id="password">
    </div>
    @if ($errors->has('password'))
        @foreach ($errors->get('password') as $error)
            <div class="invalid-tooltip mb-3">{{ $error }}</div>
        @endforeach
    @endif
    <button class="btn btn-primary">Create</button>
</form>