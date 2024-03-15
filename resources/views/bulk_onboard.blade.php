<!-- resources/views/bulk_onboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bulk Onboard Casual Employees') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('bulk.onboard') }}" enctype="multipart/form-data">
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

                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
