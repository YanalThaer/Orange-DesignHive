@extends('layouts.public')
@section('title', 'DesignHive | Profile')
@section('content')
<main class="main">
  @php
  $username = $user->name;
  $facebook = $user->profile->facebook ?? '#';
  $twitter = $user->profile->twitter ?? '#';
  $instagram = $user->profile->instagram ?? '#';
  $linkedin = $user->profile->linkedin ?? '#';
  $bio = $user->profile->bio ?? 'No Bio';
  $profileimage = $user->profile->profile_picture;
  $profileimage = $profileimage
      ? (Str::startsWith($profileimage, ['http://', 'https://']) ? $profileimage : asset($profileimage))
      : asset('assets/img/person/person-f-7.webp');
  @endphp
  <section id="author-profile" class="author-profile section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="author-profile-1">
        <div class="row">
          <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="author-card" data-aos="fade-up">
              <div class="author-image">
                <img src="{{ $profileimage }}" alt="Author" class="img-fluid rounded">
              </div>
              <div class="author-info">
                <h2>{{ $username ?? 'No User Name' }}</h2>
                <div class="author-stats d-flex justify-content-between text-center my-4">
                  <div class="stat-item">
                    <h4 data-purecounter-start="0" data-purecounter-end="{{ $user->projects_count ?? 0 }}" data-purecounter-duration="1" class="purecounter"></h4>
                    <p>Projects</p>
                  </div>
                  <div class="stat-item">
                    <h4 data-purecounter-start="0" data-purecounter-end="{{ $user->comments_count ?? 0 }}" data-purecounter-duration="1" class="purecounter"></h4>
                    <p>Comments</p>
                  </div>
                  <div class="stat-item">
                    <h4 data-purecounter-start="0" data-purecounter-end="{{ $user->likes_count ?? 0 }}" data-purecounter-duration="1" class="purecounter"></h4>
                    <p>Likes</p>
                  </div>
                </div>
                <div class="social-links">
                  <a href="{{ $twitter }}" class="twitter"><i class="bi bi-twitter-x"></i></a>
                  <a href="{{ $facebook }}" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="{{ $instagram }}" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="{{ $linkedin }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="author-content" data-aos="fade-up" data-aos-delay="200">
              <div class="content-header d-flex justify-content-between">
                @auth
                @php
                $message = $subscriptionType;
                if ($subscriptionType === 'Normal' || $subscriptionType === 'Basic') {
                    $message = 'You need to upgrade your subscription to access this feature.';
                }
                @endphp
                @if (Auth::user()->id == $user->id)
                <h3>About Me</h3>
                <a href="{{ route('usersprofile.edit', $user->id) }}" class="btn btn-dark mb-3">
                  <i class="bi bi-pencil"></i> Edit Profile
                </a>
                @else
                <h3>{{ $username }}'s Profile</h3>
                <button type="button" class="btn btn-dark mb-3" id="getInTouchButton" data-subscription-message="{{ $message }}">
                  <i class="bi bi-pencil"></i> Get in Touch
                </button>
                @endif
                @else
                <h3>{{ $username }}'s Profile</h3>
                <button type="button" class="btn btn-dark mb-3" id="getInTouchButton" data-login-required="true">
                  <i class="bi bi-pencil"></i> Get in Touch
                </button>
                @endauth
              </div>
              <div class="content-body">
                <p>{{ $bio }}</p>
                <div class="featured-articles mt-5">
                  <h4>Projects</h4>
                  <div class="row g-4">
                    @if ($user->projects->isEmpty())
                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="300">
                      <p>No projects available</p>
                    </div>
                    @else
                    @foreach($user->projects as $project)
                    @php
                    $image = $project->images->first()?->image;
                    $categoryImage = $image
                      ? (Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image))
                      : asset('assets/img/blog/blog-hero-2.webp');
                    $categoryName = $project->category->name ?? 'No Category Name';
                    $projectTitle = $project->title ?? 'No Title';
                    $projectCreatedAt = $project->created_at->diffForHumans() ?? 'No Date';
                    @endphp
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                      <article class="article-card">
                        <div class="article-img">
                          <img src="{{ $categoryImage }}" alt="Article" class="img-fluid">
                        </div>
                        <div class="article-details">
                          <div class="post-category">{{ $categoryName }}</div>
                          <h5><a href="{{ route('project.details', $project->id) }}">{{ $projectTitle }}</a></h5>
                          <div class="post-meta">
                            <span><i class="bi bi-clock"></i> {{ $projectCreatedAt }}</span>
                          </div>
                        </div>
                        @auth
                        @if (Auth::user()->id == $user->id)
                        <div class="article-actions mt-3 text-center">
                          <a href="{{ route('edit.project', $project->id) }}" class="btn btn-sm" style="background-color: #420363; color: white; padding: 5px 20px;">Edit</a>
                          <button type="button" class="btn btn-sm btn-delete" style="background-color: #343a40; color: white; padding: 5px 20px;"
                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                            data-project-id="{{ $project->id }}">
                            Delete
                          </button>
                        </div>
                        @endif
                        @endauth
                      </article>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Are you sure you want to delete this project? This action cannot be undone.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login Required</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>You need to log in to get in touch with this user.</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="subscriptionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upgrade Required</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>You need to upgrade your subscription to access this feature.</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('subecribtion') }}" class="btn btn-warning">View Plans</a>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var projectId = button.getAttribute('data-project-id');
      var form = document.getElementById('deleteForm');
      form.action = '/projects/' + projectId;
    });
    var getInTouchButton = document.getElementById('getInTouchButton');
    if (getInTouchButton) {
      getInTouchButton.addEventListener('click', function () {
        if (this.dataset.loginRequired) {
          new bootstrap.Modal(document.getElementById('loginModal')).show();
        } else if (this.dataset.subscriptionMessage) {
          new bootstrap.Modal(document.getElementById('subscriptionModal')).show();
        } else {
          window.location.href = "{{ route('chat.index', $user->id) }}";
        }
      });
    }
  });
</script>
@endsection
