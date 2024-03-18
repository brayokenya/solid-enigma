<form action="{{ route('casual.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="file">Choose Excel File:</label>
        <input type="file" name="file" class="form-control-file" id="file">
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
