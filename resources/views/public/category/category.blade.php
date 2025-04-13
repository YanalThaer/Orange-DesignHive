@extends('layouts.public')
@section('title', 'DesignHive | Categories')
@section('content')
<main class="main">
<section id="category-section" class="blog-hero section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Category Section</h2>
    <div><span class="description-title">Category Section</span></div>
  </div>
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      @foreach($categories as $category)
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
      <div class="col-lg-4 col-md-6 col-12">
        <article class="blog-item" data-aos="fade-up" data-aos-delay="100">
          <a href="{{ route('category.posts', $category->id) }}">
            <img src="{{ $imagePath }}" alt="{{ $name }}" class="img-fluid">
          </a>
          <div class="blog-content">
            <h3 class="post-title">
              <a href="{{ route('category.posts', $category->id) }}" title="{{ $name }}">
                {{ $name }}
              </a>
            </h3>
          </div>
        </article>
      </div>
      @endforeach
    </div>
  </div>
</section>
</main>
@endsection