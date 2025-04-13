@extends('layouts.public')
@section('title', 'DesignHive | Posts')
@section('content')
<style>
    .pagination .page-item.active .page-link {
        background-color: #420363;
        border-color: #420363;
        color: white;
    }
    
    .pagination .page-link {
        color: #420363;
    }
    
    .pagination .page-link:hover {
        color: #2a0242;
    }
</style>
<main class="main">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <section id="category-postst" class="category-postst section">
          <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
              @if ($projects->isEmpty())
              <div class="col-lg-12 text-center">
                <h2 class="text-center">No Projects Found</h2>
                <p class="text-center">Sorry, but there are no projects available at the moment.</p>
              </div>
              @else
              @foreach($projects as $project)
              <div class="col-lg-6">
                @include('layouts.public.__projects', ['project' => $project])
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </section>
        <section id="pagination-2" class="pagination-2 section">
          <div class="container">
            <div class="d-flex justify-content-center">
              {{ $projects->links() }}
            </div>
          </div>
        </section>
      </div>
      @include('layouts.public.__categoryandtask')
    </div>
  </div>
</main>
@endsection