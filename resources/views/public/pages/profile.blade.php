@extends('layouts.public')
@section('title', 'DesignHive | Profile')
@section('content')
<main class="main">
  @php
  $username = $user->name;
  $facebook = $user->profile->facebook;
  $twitter = $user->profile->twitter;
  $instagram = $user->profile->instagram;
  $linkedin = $user->profile->linkedin;
  $bio = $user->profile->bio;
  $profileimage = $user->profile->profile_picture;
  if (empty($profileimage)) {
  $profileimage = asset('assets/img/person/person-f-7.webp');
  } else {
  $profileimage = Str::startsWith($profileimage, ['http://', 'https://']) ? $profileimage : asset($profileimage);
  }
  if (empty($bio)) {
  $bio = 'No Bio';
  } else {
  $bio = $user->profile->bio;
  }
  if (empty($facebook)) {
  $facebook = '#';
  } else {
  $facebook = $user->profile->facebook;
  }
  if (empty($twitter)) {
  $twitter = '#';
  } else {
  $twitter = $user->profile->twitter;
  }
  if (empty($instagram)) {
  $instagram = '#';
  } else {
  $instagram = $user->profile->instagram;
  }
  if (empty($linkedin)) {
  $linkedin = '#';
  } else {
  $linkedin = $user->profile->linkedin;
  }
  if (empty($username)) {
  $username = 'No User Name';
  } else {
  $username = $user->name;
  }
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
                <h2>{{ $username }}</h2>
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
                @if (Auth::user()->id == $user->id)
                <h3>About Me</h3>
                <a href="{{ route('usersprofile.edit', $user->id) }}" class="btn btn-dark mb-3">
                  <i class="bi bi-pencil"></i> Edit Profile
                </a>
                @else
                <h3>{{ $username }}'s Profile</h3>
                <a href="{{ route('chat.index', $user->id) }}" class="btn btn-dark mb-3">
                  <i class="bi bi-pencil"></i> Get in Touch
                </a>
                @endif
                @else
                <h3>{{ $username }}'s Profile</h3>
                <button type="button" class="btn btn-dark mb-3" id="getInTouchButton">
                  <i class="bi bi-pencil"></i> Get in Touch
                </button>
                @endauth
              </div>
              <div class="content-body">
                <p>
                  {{ $bio }}
                </p>
                <div class="expertise-areas">
                  <h4>Areas of Expertise</h4>
                  <div class="tags">
                    @if ($user->tags->isEmpty())
                    <span class="no-tags">No tags available</span>
                    @else
                    @foreach($user->tags as $tag)
                    <span>{{ $tag->name ?? 'No Tags Name' }}</span>
                    @endforeach
                    @endif
                  </div>
                </div>
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
                    if (empty($project->image)) {
                    $categoryImage = asset('assets/img/blog/blog-hero-2.webp');
                    } elseif (Str::startsWith($project->image, ['http://', 'https://'])) {
                    $categoryImage = $project->image;
                    } else {
                    $categoryImage = asset($project->image);
                    }

                    if (empty($project->category->name)) {
                    $categoryName = 'No Category Name';
                    } else {
                    $categoryName = $project->category->name;
                    }

                    if (empty($project->title)) {
                    $projectTitle = 'No Title';
                    } else {
                    $projectTitle = $project->title;
                    }

                    if (empty($project->created_at->diffForHumans())) {
                    $projectCreatedAt = 'No Date';
                    } else {
                    $projectCreatedAt = $project->created_at->diffForHumans();
                    }
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
                            <span><i class="bi bi-clock"></i> {{ $projectCreatedAt }} </span>
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
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this project? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You need to log in to get in touch with this user.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var projectId = button.getAttribute('data-project-id');
      var form = document.getElementById('deleteForm');
      form.action = '/projects/' + projectId;
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var getInTouchButton = document.getElementById('getInTouchButton');

    if (getInTouchButton) {
      getInTouchButton.addEventListener('click', function() {
        // فتح الـ Modal عند الضغط على الزر
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
      });
    }
  });
</script>

@endsection