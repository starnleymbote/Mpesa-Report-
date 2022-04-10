@extends('layouts.test')

@section('content')

<main id="main" class="main">
  
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Transactions</a></li>
        <li class="breadcrumb-item active">Daily</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  
  <div class="card">
      
        <div class="card-body">
          <h5 class="card-title">Daily Transactions</h5>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Amount</th>
                <th scope="col">Received On</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Brandon Jacob</td>
                <td>0722123456</td>
                <td>280</td>
                <td>2016-05-25</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Bridie Kessler</td>
                <td>0722123457</td>
                <td>350</td>
                <td>2014-12-05</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Ashleigh Langosh</td>
                <td>0722123459</td>
                <td>450</td>
                <td>2011-08-12</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Angus Grady</td>
                <td>0722123456</td>
                <td>340</td>
                <td>2012-06-11</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Raheem Lehner</td>
                <td>0722123453</td>
                <td>470</td>
                <td>2011-04-19</td>
              </tr>
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>
</main><!-- End #main -->
@endsection