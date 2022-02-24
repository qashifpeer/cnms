@extends('admin.admin_master')
@section('admin')
<style>
  .upload {
      max-width: 500px;
  }
  dl, ol, ul {
      margin: 0;
      padding: 0;
      list-style: none;
  }
</style>

    <div class="container upload mt-5">
        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
          @csrf
          <h3 class="text-center mb-5">Upload File in Laravel</h3>
          <h5>Logged In As:{{ Auth::guard('admin')->user()->user_type }}</h5>
          
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <input type="hidden" name="user_type" value="{{ Auth::guard('admin')->user()->user_type }}">
          <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}">
          <div class="input-group">
            <input type="file" name="file" class="form-control" id="customFile">
          </div>
          <div class="form-group">
            <label for="description">Brief Description About Note</label>
            <textarea class="form-control"  name="description" rows="3"></textarea>
          </div>
          <button class="btn btn btn-primary" type="submit" id="customFile">Upload</button>
        </form>
    </div>

    @endsection
