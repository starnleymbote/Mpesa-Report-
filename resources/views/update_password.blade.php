@extends('layouts.test')

@section('content')

<main id="main" class="main">

<section class="section">

    @if(session()->has('error'))
      <div class="alert alert-danger">
          {{ session()->get('error') }}
      </div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
  @endif

    <div class="row">
      <div class="col-lg-10 offset-lg-1">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Password</h5>

            <!-- General Form Elements -->
            <form action="{{ route('change.password') }}" method="POST">

              @csrf

              <div class="row mb-3">

                <label for="inputText" class="col-sm-2 col-form-label">Current Password</label>
                
                <div class="col-sm-10">
                
                  <input type="password" name="current_password" class="form-control">

                  @if($errors->has('current_password')) 

                      <strong style="color: #ff0000">{{ $errors->first('current_password') }}</strong>

                  @endif
                
                </div>

              </div>
              
              <div class="row mb-3">

                <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                
                <div class="col-sm-10">
                
                  <input type="password" name="password" class="form-control">

                  @if($errors->has('password')) 

                      <strong style="color: #ff0000">{{ $errors->first('password') }}</strong>

                  @endif
                
                </div>
              </div>

              <div class="row mb-3">
              
                <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
              
                <div class="col-sm-10">
              
                  <input type="password" name="password_confirmation" class="form-control">
                  
                  @if($errors->has('password_confirmation')) 

                      <strong style="color: #ff0000">{{ $errors->first('password_confirmation') }}</strong>

                  @endif

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