@extends('layouts.public')
@section('title', 'DesignHive | Search Results')
@section('content')
<main class="main">
    <div class="container">
        @if($projects->isEmpty() && $categoriesSearch->isEmpty())
        <div class="no-results">
            <h2>No Results Found</h2>
            <p>Sorry, we couldn't find any projects or categories matching your search.</p>
        </div>
        @else
        @if(!$projects->isEmpty())
        <section id="latest-posts" class="latest-posts section" style="padding-top: 0px;">
            <div class="container section-title" data-aos="fade-up">
                <div><span>Check Our</span> <span class="description-title"> Posts</span></div>
            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4" id="projects-container">
                    @foreach($projects as $project)
                    <div class="col-lg-4 col-md-6 project-item">
                        @include('layouts.public.__projects', ['project' => $project])
                    </div>
                    @endforeach
                </div>
                @endif
                @if(!$categoriesSearch->isEmpty())
                <section id="category-section" class="blog-hero section">
                    <div class="container section-title" data-aos="fade-up">
                        <div><span class="description-title">Category</span></div>
                    </div>
                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div class="row gy-4">
                            @foreach($categoriesSearch as $category)
                            @php
                            $name = $category->name ?: 'No Category Name';
                            $image = Str::startsWith($category->image, ['http://', 'https://'])
                            ? $category->image
                            : ($category->image ? asset($category->image) : asset('assets/img/blog/blog-hero-2.webp'));
                            @endphp
                            <div class="col-lg-4 col-md-6 col-12">
                                <article class="blog-item" data-aos="fade-up" data-aos-delay="100">
                                    <a href="{{ route('category.posts', $category->id) }}">
                                        <img src="{{ $image }}" alt="{{ $name }}" class="img-fluid">
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
                        @endif
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection