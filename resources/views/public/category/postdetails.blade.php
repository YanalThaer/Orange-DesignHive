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
              <div class="hero-img" data-aos="zoom-in">
                <img src="{{ $imagePath }}" alt="Featured blog image" class="img-fluid" loading="lazy">
                <div class="meta-overlay">
                  <div class="meta-categories">
                    <a href="" class="category">{{ $categoryname }}</a>
                    <span class="divider">•</span>
                    <span class="reading-time"><i class="bi bi-clock"></i>{{ $date }}</span>
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
                  <div class="tags-section">
                    <h4>Tages</h4>
                    <div class="tags">
                      @if ($project->tags->isEmpty())
                      <span class="no-tags">No tags available</span>
                      @else
                      @foreach ($project->tags as $tag)
                      <a href="#" class="tag">{{ $tag->name ?? 'No Tag' }}</a>
                      @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </section>
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
@endsection