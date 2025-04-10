<article>
    @php
    $imagePath = $project->image;
    $categoryname = $project->category->name;
    $title = $project->title;
    $date = $project->created_at->format('M j, Y');
    $userpicture = $project->user->profile->profile_picture;
    $username = $project->user->name;

    if (empty($username)) {
        $username = 'No User Name';
    }

    if (empty($userpicture)) {
        $userpicture = asset('assets/img/person/person-f-7.webp');
    } else {
        $userpicture = Str::startsWith($userpicture, ['http://', 'https://']) ? $userpicture : asset($userpicture);
    }

    if (empty($date)) {
        $date = 'No Date';
    }

    if (empty($title)) {
        $title = 'No Title';
    }

    if (empty($categoryname)) {
        $categoryname = 'No Category Name';
    }

    if (empty($imagePath)) {
        $imagePath = asset('assets/img/blog/blog-hero-2.webp');
    } else {
        $imagePath = Str::startsWith($imagePath, ['http://', 'https://']) ? $imagePath : asset($imagePath);
    }
    @endphp

    <!-- Project Image -->
    <div class="post-img">
        <img src="{{ $imagePath }}" alt="{{ $project->title }}" class="w-100 rounded-3" style="height: 250px; object-fit: cover;">
    </div>

    <!-- Project Category -->
    <p class="post-category text-muted">{{ $categoryname }}</p>

    <!-- Project Title -->
    <h2 class="title">
        <a href="{{ route('project.details', $project->id) }}" class="text-dark">{{ $title }}</a>
    </h2>

    <!-- Author Info -->
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

    <!-- Engagement Section (Like, Comment, Chat) -->
    <div class="post-engagement d-flex align-items-center gap-3">
        <!-- Like Button -->
        @auth
        <button class="btn btn-sm like-btn d-flex align-items-center gap-1" style="border-width: none; background: transparent;" data-project-id="{{ $project->id }}">
            <i class="like-icon {{ $project->userLike ? 'bi bi-heart-fill text-danger' : 'bi bi-suit-heart' }} fs-4"></i>
            <span class="like-count text-muted">{{ $project->likes_count ?? 0 }}</span>
        </button>

        <!-- Comment Button -->
        <a href="{{ route('project.details', $project->id) }}" class="btn btn-sm d-flex align-items-center gap-1" style="border-width: none; background: transparent;">
            <i class="bi bi-chat-dots fs-4 text-muted"></i>
            <span class="text-muted">{{ $project->comments_count ?? 0 }}</span>
        </a>

        <!-- Chat Button -->
        @if($project->user_id != Auth::user()->id)
        <a href="{{ route('chat.index', $project->user_id) }}" class="d-flex align-items-center gap-1 text-decoration-none">
            <i class="bi bi-chat fs-4 text-muted"></i>
            <span class="text-muted">Chat</span>
        </a>
        @endif
        @else
        <!-- Like Button for Guest -->
        <button class="btn btn-sm like-btn d-flex align-items-center gap-1 guest-action" style="border-width: none; background: transparent;" data-action="like">
            <i class="bi bi-heart fs-4 text-muted"></i>
            <span class="like-count text-muted">{{ $project->likes_count ?? 0 }}</span>
        </button>

        <!-- Comment Button for Guest -->
        <button class="btn btn-sm d-flex align-items-center gap-1 guest-action" style="border-width: none; background: transparent;" data-action="comment">
            <i class="bi bi-chat-dots fs-4 text-muted"></i>
            <span class="text-muted">{{ $project->comments_count ?? 0 }}</span>
        </button>

        <!-- Chat Button for Guest -->
        <button class="btn btn-sm d-flex align-items-center gap-1 guest-action text-decoration-none" style="border-width: none; background: transparent;" data-action="chat">
            <i class="bi bi-chat fs-4 text-muted"></i>
            <span class="text-muted">Chat</span>
        </button>
        @endauth
    </div>
</article>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-message">You need to log in to perform this action.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom modal backdrop styling */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5) !; /* Semi-transparent black */
        opacity: 1 !important; /* Ensure it's visible */
    }
    
    /* Modal content styling */
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    
    /* Modal header styling */
    .modal-header {
        border-bottom: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }
    
    /* Modal body styling */
    .modal-body {
        padding: 1.5rem;
    }
    
    /* Modal footer styling */
    .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 1rem 1.5rem;
    }
    
    /* Button styling */
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modal
    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    const modalMessage = document.getElementById('modal-message');
    
    // Handle guest actions
    const guestButtons = document.querySelectorAll('.guest-action');
    
    guestButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the action type
            const action = this.getAttribute('data-action');
            let message = 'You need to log in to perform this action.';
            
            // Customize message based on action
            switch(action) {
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
            
            // Update modal message
            modalMessage.textContent = message;
            
            // Show modal
            loginModal.show();
        });
    });
    
    // Ensure modal closes properly when clicking the close button
    document.querySelector('#loginModal .btn-close').addEventListener('click', function() {
        loginModal.hide();
    });
    
    // Ensure modal closes properly when clicking the Close button in footer
    document.querySelector('#loginModal .btn-secondary').addEventListener('click', function() {
        loginModal.hide();
    });
    
    // Handle backdrop click (clicking outside the modal)
    document.getElementById('loginModal').addEventListener('click', function(e) {
        if (e.target === this) {
            loginModal.hide();
        }
    });
});
</script>