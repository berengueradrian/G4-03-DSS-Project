<h1> NEW USER </h1>

<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <label for="title"> Title </label>
    <input type="text" name="title" id="title">
    <br>
    <label for="body">Body</label>
    <textarea name="body" id="body"></textarea>
    <br>
    <input type="submit">
</form>