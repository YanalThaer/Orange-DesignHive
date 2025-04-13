@extends('layouts.public')
@section('title', 'DesignHive | Post Details')
@section('content')
@php
$imagePath = $project->image;
$categoryname = $project->category->name;
$title = $project->title;
$description = $project->description;
$date = $project->created_at->diffForHumans();
$datemonth = $project->created_at->format('M j, Y');
$userpicture = $project->user->profile->profile_picture;
$username = $project->user->name;
if (empty($username)) {
$username = 'No User Name';
} else {
$username = $project->user->name;
}
if (empty($userpicture)) {
$userpicture = asset('assets/img/person/person-f-7.webp');
} else {
$userpicture = Str::startsWith($userpicture, ['http://', 'https://']) ? $userpicture : asset($userpicture);
}
if (empty($date)) {
$date = 'No Date';
} else {
$date = $project->created_at->format('M j, Y');
$datemonth = $project->created_at->format('M j, Y');
}
if (empty($description)) {
$description = 'No Description';
} else {
$description = $project->description;
}
if (empty($title)) {
$title = 'No Title';
} else {
$title = $project->title;
}
if (empty($categoryname)) {
$categoryname = 'No Category Name';
} else {
$categoryname = $project->category->name;
}
if (empty($imagePath)) {
$imagePath = asset('assets/img/blog/blog-hero-2.webp');
} else {
$imagePath = Str::startsWith($imagePath, ['http://', 'https://']) ? $imagePath : asset($imagePath);
}
@endphp
<main class="main">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <section id="blog-details" class="blog-details section">
          <div class="container" data-aos="fade-up">
            <article class="article">
              <div class="hero-img position-relative" data-aos="zoom-in" style="height: 400px;">
                @if($project->images->count())
                <div id="carouselProject{{ $project->id }}" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="3000">
                  <div class="carousel-inner h-100">
                    @foreach($project->images as $index => $image)
                    <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                      <img
                        src="{{ Str::startsWith($image->image, ['http', 'https']) ? $image->image : asset($image->image) }}"
                        class="d-block w-100 h-100 rounded-3"
                        style="object-fit: cover;"
                        alt="Project Image {{ $index + 1 }}">
                    </div>
                    @endforeach
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselProject{{ $project->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselProject{{ $project->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
                @else
                <img src="{{ asset('assets/img/blog/blog-hero-2.webp') }}" class="img-fluid w-100 h-100 rounded-3" style="object-fit: cover;" alt="Default Image">
                @endif
                <div class="meta-overlay position-absolute bottom-0 start-0 w-100 px-3 py-2" style="background: rgba(0,0,0,0.4); color: white; border-bottom-left-radius: 0.75rem; border-bottom-right-radius: 0.75rem;">
                  <div class="meta-categories d-flex align-items-center justify-content-between">
                    <a href="" class="category text-white fw-bold">{{ $categoryname }}</a>
                    <span class="reading-time"><i class="bi bi-clock me-1"></i>{{ $date }}</span>
                  </div>
                </div>
              </div>
              <div class="article-content" data-aos="fade-up" data-aos-delay="100">
                <div class="content-header">
                  <h1 class="title">{{ $title }}</h1>
                  <div class="author-info">
                    <div class="author-details">
                      <img src="{{ $userpicture }}" alt="Author" class="author-img">
                      <div class="info">
                        <h4><a href="{{ route('profile', $project->user->id) }}">{{ $username }}</a></h4>
                        <span class="role">{{ $categoryname }}</span>
                      </div>
                    </div>
                    <div class="post-meta">
                      <span class="date"><i class="bi bi-calendar3"></i> {{ $datemonth }}</span>
                      <span class="divider">•</span>
                      <span class="comments"><i class="bi bi-chat-text"></i> {{ $project->comments_count ?? 0 }}</span>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <p class="lead">
                    {{ $description }}
                  </p>
                </div>
                <div class="meta-bottom">
                  <div class="tags-section mt-4">
                    <h4 class="mb-3 text-secondary">Tags</h4>
                    <ul class="list-unstyled d-flex flex-wrap gap-2">
                      @if ($project->tags->isEmpty())
                      <li><span class="text-muted fst-italic">No tags available</span></li>
                      @else
                      @foreach($project->tags as $tag)
                      @php
                      $tagname = $tag->name ?: 'No Tag';
                      @endphp
                      <li>
                        <a href="{{ route('projects.byTag', $tag->id) }}"
                          class="text-decoration-none px-3 py-2 rounded-pill d-inline-block"
                          style="background-color: #dee2e6; color: #333; font-size: 0.9rem;">
                          #{{ $tagname }}
                        </a>
                      </li>
                      @endforeach
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </section>
        <div class="project-gallery mt-4">
          <h4 class="mb-3 text-secondary">More Images</h4>
          <div class="row g-3">
            @php
            $additionalImages = $project->images->take(5);
            @endphp
            @forelse ($additionalImages as $image)
            <div class="col-12 col-md-6 col-lg-4">
              <div class="image-wrapper rounded overflow-hidden shadow-sm">
                <img
                  src="{{ Str::startsWith($image->image, ['http', 'https']) ? $image->image : asset($image->image) }}"
                  alt="Project Image"
                  class="img-fluid w-100 h-100"
                  style="object-fit: cover; aspect-ratio: 4/3;">
              </div>
            </div>
            @empty
            <p class="text-muted">No additional images found.</p>
            @endforelse
          </div>
        </div>
        <section id="blog-comments" class="blog-comments section">
          <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="blog-comments-3">
              <div class="section-header">
                <h3>Discussion <span class="comment-count">{{ $project->comments_count ?? 0 }}</span></h3>
              </div>
              <div class="comments-wrapper">
                @if ($project->comments->isEmpty())
                <div class="no-comments">No comments available</div>
                @else
                @foreach($project->comments as $comment)
                @php
                $picture = $comment->user->profile->profile_picture;
                $commentusername = $comment->user->name;
                if (empty($commentusername)) {
                $commentusername = 'No User Name';
                } else {
                $commentusername = $comment->user->name;
                }
                if (empty($picture)) {
                $picture = asset('assets/img/person/person-f-7.webp');
                } else {
                $picture = Str::startsWith($picture, ['http://', 'https://']) ? $picture : asset($picture);
                }
                @endphp
                <article class="comment-card">
                  <div class="comment-header">
                    <div class="user-info">
                      <img src="{{ $picture }}" alt="User avatar" loading="lazy">
                      <div class="meta">
                        <h4 class="name">{{ $commentusername }}</h4>
                        <span class="date"><i class="bi bi-calendar3"></i>{{ $comment->created_at->diffForHumans() ?? 'No Date' }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="comment-content">
                    <p>{{ $comment->content ?? 'No Comment' }}</p>
                  </div>
                </article>
                @endforeach
                @endif
              </div>
            </div>
          </div>
        </section>
        <section id="blog-comment-form" class="blog-comment-form section">
          <div class="container" data-aos="fade-up" data-aos-delay="100">
            <form method="post" role="form" action="{{ route('projects.comments.store', $project->id) }}">
              @csrf
              @method('POST')
              <div class="section-header">
                <h3>Share Your Thoughts</h3>
              </div>
              <div class="row gy-3">
                <div class="col-12 form-group">
                  <label for="comment">Your Comment *</label>
                  <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="@guest Please login to write a comment... @else Write your thoughts here... @endguest"
                    @guest disabled @endguest required></textarea>
                </div>
                <div class="col-12 text-center">
                  <button type="submit" class="btn-submit" @guest disabled style="cursor: not-allowed; opacity: 0.5;" @endguest>Post Comment</button>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
      @include('layouts.public.__categoryandtask')
    </div>
  </div>
</main>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carousel => {
      new bootstrap.Carousel(carousel, {
        interval: 3000,
        ride: 'carousel'
      });
    });
  });
</script>
@endsection