@extends('layouts.test')

@section('content')

<main id="main" class="main">

<section class="section">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Profile</h5>

            <!-- General Form Elements -->
            <form>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Full Names</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control">
                </div>
              </div>
              
              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control">
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Upload Profile</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile">
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Submit Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit Form</button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>

    </div>
  </section>

</main>

@endsection