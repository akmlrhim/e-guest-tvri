@extends('layouts.free_user.main')

@section('content')

<div class="container-fluid centered-container">
  <div class="row justify-content-center">
    <div class="col-md-20">
      <h2 class="text-center mb-4">ID Card Form</h2>
      <form>
        <div class="mb-3">
          <label for="fullName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
        </div>
        <div class="mb-3">
          <label for="idNumber" class="form-label">ID Number</label>
          <input type="text" class="form-control" id="idNumber" placeholder="Enter ID number">
        </div>
        <div class="mb-3">
          <label for="photoUpload" class="form-label">Upload Photo</label>
          <input class="form-control" type="file" id="photoUpload">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email address">
        </div>
        <div class="mb-3">
          <label for="phoneNumber" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter phone number">
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection