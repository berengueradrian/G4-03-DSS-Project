<h3 style="padding-bottom: 20px"><strong>Create collection</strong></h3>

<form action="{{ route('collection.store') }}" method="POST">
    @csrf
    <label for="name"> Name </label>
    <input type="text" name="name" id="name">
    <br>
    <label for="body">Body</label>
    <textarea name="body" id="body"></textarea>
    <br>
    <input type="submit">
</form>