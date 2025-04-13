{{-- يبدأ المقال --}}
<article>
    @php
    $image = $project->images->first()?->image;
    $imagePath = $image ? (Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : asset('assets/img/blog/blog-hero-2.webp');
    $categoryname = $project->category->name ?? 'No Category Name';
    $title = $project->title ?? 'No Title';
    $date = $project->created_at ? $project->created_at->format('M j, Y') : 'No Date';
    $userpicture = $project->user->profile->profile_picture;
    $username = $project->user->name ?? 'No User Name';

    if (empty($userpicture)) {
    $userpicture = asset('assets/img/person/person-f-7.webp');
    } else {
    $userpicture = Str::startsWith($userpicture, ['http://', 'https://']) ? $userpicture : asset($userpicture);
    }
    @endphp
    <div class="post-img">
        <a href="{{ route('project.details', $project->id) }}">
            <img src="{{ $imagePath }}" alt="{{ $title }}" class="w-100 rounded-3" style="height: 250px; object-fit: cover;">
        </a>
        @if (!$image)
        <p class="text-muted">This project has no images.</p>
        @endif
    </div>
    <p class="post-category text-muted">{{ $categoryname }}</p>
    <div class="d-flex align-items-center mb-3">
        <img src="{{ $userpicture }}" alt="{{ $username }}" class="img-fluid post-author-img flex-shrink-0 rounded-circle" style="width: 40px; height: 40px;">
        <div class="post-meta ms-2">
            <p class="post-author mb-0">
                <a href="{{ route('profile', $project->user->id) }}" class="text-muted">{{ $username }}</a>
            </p>
            <p class="post-date text-muted">
                <time datetime="{{ $project->created_at->format('Y-m-d') }}">{{ $date }}</time>
            </p>
        </div>
    </div>
    <div class="post-engagement d-flex align-items-center gap-3">
    @auth
    @php
    $subscriptionType = $subscriptionType;
    $message = null;
    if ($subscriptionType === 'Normal') {
        $message = 'You need to upgrade your subscription to access this feature.';
    } elseif ($subscriptionType === 'Basic') {
        $message = 'You need to upgrade your subscription to access this feature.';
    }
    @endphp
    <button class="btn btn-sm like-btn d-flex align-items-center gap-1" style="border-width: none; background: transparent;" data-project-id="{{ $project->id }}">
        <i class="like-icon {{ $project->userLike ? 'bi bi-heart-fill text-danger' : 'bi bi-suit-heart' }} fs-4"></i>
        <span class="like-count text-muted">{{ $project->likes_count ?? 0 }}</span>
    </button>
    <a href="{{ route('project.details', $project->id) }}" class="btn btn-sm d-flex align-items-center gap-1" style="border-width: none; background: transparent;">
        <i class="bi bi-chat-dots fs-4 text-muted"></i>
        <span class="text-muted">{{ $project->comments_count ?? 0 }}</span>
    </a>
    @if ($message && $project->user_id != Auth::user()->id)
        <a href="#" class="d-flex align-items-center gap-1 text-decoration-none" data-bs-toggle="modal" data-bs-target="#subscriptionModal">
            <i class="bi bi-chat fs-4 text-muted"></i>
            <span class="text-muted">Chat</span>
        </a>
    @else
        @if ($project->user_id != Auth::user()->id)
        <a href="{{ route('chat.index', $project->user_id) }}" class="d-flex align-items-center gap-1 text-decoration-none">
            <i class="bi bi-chat fs-4 text-muted"></i>
            <span class="text-muted">Chat</span>
        </a>
        @endif
    @endif
    @else
    <button class="btn btn-sm like-btn d-flex align-items-center gap-1 guest-action" data-action="like">
        <i class="bi bi-heart text-muted fs-4"></i>
        <span class="like-count text-muted">{{ $project->likes_count ?? 0 }}</span>
    </button>
    <button class="btn btn-sm d-flex align-items-center gap-1 guest-action" data-action="comment">
        <i class="bi bi-chat-dots fs-4 text-muted"></i>
        <span class="text-muted">{{ $project->comments_count ?? 0 }}</span>
    </button>
    <button class="btn btn-sm d-flex align-items-center gap-1 guest-action" data-action="chat">
        <i class="bi bi-chat fs-4 text-muted"></i>
        <span class="text-muted">Chat</span>
    </button>
    @endauth
</div>
</article>
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subscriptionModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @auth
                <p>{{ $message ?? 'You have full access to this feature!' }}</p>
                @else
                <p>You need to log in to perform this action.</p>
                @endauth
            </div>
            <div class="modal-footer">
                @auth
                <a href="{{ route('subecribtion') }}" class="btn btn-primary">Upgrade Now</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-backdrop {
        background-color: #000 !important;
        opacity: 0.5 !important;
    }

    .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subscriptionModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
        const guestButtons = document.querySelectorAll('.guest-action');

        guestButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.getAttribute('data-action');
                let message = 'You need to log in to perform this action.';

                switch (action) {
                    case 'like':
                        message = 'You need to log in to like this project.';
                        break;
                    case 'comment':
                        message = 'You need to log in to leave a comment.';
                        break;
                    case 'chat':
                        message = 'You need to log in to chat with the project owner.';
                        break;
                }

                document.querySelector('#subscriptionModal .modal-body').innerHTML = `<p>${message}</p>`;
                subscriptionModal.show();
            });
        });
    });
</script>