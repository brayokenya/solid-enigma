
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bulk Onboard Casual Employees') }}</div>

                    <div class="card-body">

                        <!-- bulk_onboard.blade.php -->
<form id="bulkOnboardForm" method="POST" action="{{ route('bulk.onboard') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="file">{{ __('Upload Excel File') }}</label>
        <input id="file" type="file" class="form-control-file" name="file" required>
        @error('file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="button" onclick="submitForm()" class="btn btn-primary">
        {{ __('Submit') }}
    </button>
</form>

<script>
    function submitForm() {
        // Get the form data
        let formData = new FormData(document.getElementById('bulkOnboardForm'));

        // Send a POST request to the /bulk-onboard route
        fetch('{{ route("bulk.onboard") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Handle the response
            console.log('Response:', response);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Redirect to a success page or handle success message
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
            // Display error message to the user
            alert('An error occurred while processing the request.');
        });
    }
</script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
