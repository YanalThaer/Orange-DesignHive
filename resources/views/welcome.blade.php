@extends('layouts.public')
@section('title', 'DesignHive | Home')
@section('content')
<main class="main">
  <section id="blog-hero" class="blog-hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="blog-grid">
        @foreach($categories->take(5) as $index => $category)
        @php
        $name = $category->name;
        $image = $category->image;
        $imagePath = $image
        ? (Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image))
        : asset('assets/img/blog/blog-hero-2.webp');
        if (empty($name) ) {
        $name = 'No Category Name';
        } else {
        $name = $category->name;
        }
        @endphp
        <article class="blog-item {{ $loop->first ? 'featured' : '' }}" data-aos="fade-up"
          data-aos-delay="{{ 100 + ($index * 100) }}">
          <a href="{{ route('category.posts', $category->id) }}">
            <img src="{{ $imagePath }}" alt="{{ $name }}" class="img-fluid">
            <div class="blog-content">
              <h{{ $loop->first ? '2' : '3' }} class="post-title">
                <a href="{{ route('category.posts', $category->id) }}" title="{{ $name }}">{{ $name }}</a>
              </h{{ $loop->first ? '2' : '3' }}>
            </div>
        </article>
        @endforeach
      </div>
    </div>
  </section>
  <section id="featured-posts" class="featured-posts section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Featured Posts</h2>
      <div><span>Check Our</span> <span class="description-title">Featured Posts</span></div>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="blog-posts-slider swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 800,
            "autoplay": {
              "delay": 5000
            },
            "grabCursor": true,
            "slidesPerView": 3,
            "spaceBetween": 30,
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 20
              },
              "768": {
                "slidesPerView": 2,
                "spaceBetween": 20
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 30
              }
            }
          }
        </script>
        <div class="swiper-wrapper">
          @foreach ($projects->where('featured_post', 1)->sortByDesc('created_at') as $project)
          @php
          $title = $project->title;
          $image = $project->images->first()?->image;
          $imagePath = $image
          ? (Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image))
          : asset('assets/img/blog/blog-hero-2.webp');
          $description = $project->description;
          $username = $project->user->name;
          $comments_count = $project->comments_count;
          $project_created_at = $project->created_at;
          if (empty($project_created_at) ) {
          $project_created_at = 'No Date';
          } else {
          $project_created_at = $project->created_at->diffForHumans();
          }
          if (empty($comments_count) ) {
          $comments_count = 0;
          } else {
          $comments_count = $project->comments_count;
          }
          if (empty($username) ) {
          $username = 'No User';
          } else {
          $username = $project->user->name;
          }
          if (empty($description) ) {
          $description = 'No Description';
          } else {
          $description = $project->description;
          }
          if (empty($title) ) {
          $title = 'No Project Name';
          } else {
          $title = $project->title;
          }
          @endphp
          <div class="swiper-slide">
            <div class="blog-post-item">
              <img src="{{ $image }}" alt="Blog Image">
              <div class="blog-post-content">
                <div class="post-meta">
                  <span><i class="bi bi-person"></i> <a href="{{ route('profile', $project->user->id) }}"
                      class="read-more">
                      {{ $username }}</span>
                  <span><i class="bi bi-clock"></i> {{ $project_created_at }}</span>
                  <span><i class="bi bi-chat-dots"></i>
                    {{ $comments_count }}</span>
                </div>
                <!-- <h2>
                  <a href="{{ route('project.details', $project->id) }}">{{ $title }}</a>
                </h2> -->
                <!-- <p>{{ Str::limit(strip_tags($description), 120) }}</p> -->
                <a href="{{ route('project.details', $project->id) }}" class="read-more">
                  Show project <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    </div>
  </section>
  <section id="latest-posts" class="latest-posts section" style="padding-top: 0px;">
    <div class="container section-title" data-aos="fade-up">
      <h2>Posts</h2>
      <div><span>Check Our</span> <span class="description-title"> Posts</span></div>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4" id="projects-container">
        @if ($projects->isEmpty())
        <div class="col-12 text-center">
          <h4>No projects available.</h4>
        </div>
        @else
        @foreach($projects->shuffle()->take(15) as $project)
        <div class="col-lg-4 project-item">
          @include('layouts.public.__projects', ['project' => $project])
        </div>
        @endforeach
        @endif
      </div>
      <div id="no-projects-message" class="text-center mt-4" style="display: none;">
        <h4>No project in this category</h4>
      </div>
    </div>
    <div class="text-center mt-4">
      <button class="btn btn-dark px-5 py-2 rounded-1 fw-bold shadow-sm">
        <a href="{{ route('category.posts' , 0) }}" class="text-white ">View All</a>
      </button>
    </div>
  </section>

  <section id="category-section" class="blog-hero section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Category Section</h2>
      <div><span class="description-title">Category Section</span></div>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-container">
        <div class="swiper-wrapper" style="display: flex;">
          @foreach($categories as $category)
          @php
          $name = $category->name;
          if (empty($category->image) ) {
          $categoryImage = asset('assets/img/blog/blog-hero-2.webp');
          } elseif (Str::startsWith($category->image, ['http://', 'https://'])) {
          $categoryImage = $category->image;
          } else {
          $categoryImage = asset($category->image);
          }
          if (empty($name) ) {
          $name = 'No Category Name';
          } else {
          $name = $category->name;
          }
          @endphp
          <div class="swiper-slide" style="width: 250px; margin-right: 30px;">
            <article class="blog-item" style="border-radius: 12px; overflow: hidden;">
              <a href="{{ route('category.posts', $category->id) }}">
                <img src="{{ $categoryImage }}" alt="{{ $category->name }}" class="img-fluid"
                  style="width: 100%; height: auto;">
              </a>
              <div class="blog-content" style="padding: 10px; text-align: center;">
                <h3 class="post-title" style="margin: 0; font-size: 16px;">
                  <a href="{{ route('category.posts', $category->id) }}" title="{{ $category->name }}">
                    {{ $name }}
                  </a>
                </h3>
              </div>
            </article>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
      let swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
          delay: 0,
          disableOnInteraction: false,
        },
        speed: 1000,
        grabCursor: true,
        mousewheel: true,
        breakpoints: {
          480: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 40,
          },
          1440: {
            slidesPerView: 4,
            spaceBetween: 50,
          }
        }
      });
      swiper.el.addEventListener('mouseenter', function() {
        swiper.autoplay.stop();
      });
      swiper.el.addEventListener('mouseleave', function() {
        swiper.autoplay.start();
      });
    </script>
  </section>

  <style>
    .modal-backdrop {
      background-color: #000 !important;
      opacity: 0.5 !important;
      /* Ensure it's visible */
    }
  </style>
</main>
@endsection