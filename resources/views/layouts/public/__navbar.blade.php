<header id="header" class="header position-relative">
    @php
    if (Auth::check()) {
    $user = Auth::user()->load('profile');
    $profileimage = $user->profile->profile_picture;
    if (empty($profileimage)) {
    $profileimage = asset('assets/img/person/person-f-7.webp');
    } else {
    $profileimage = Str::startsWith($profileimage, ['http://', 'https://']) ? $profileimage : asset($profileimage);
    }
    }
    @endphp
    <div class="container-fluid container-xl position-relative">
        <div class="top-row d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-end">
                <img src="{{ asset('assets/img/DesignHive.png') }}" alt="DesignHive Logo" class="sitename">
            </a>
            <form class="search-form input-width " action="{{ route('search') }}" method="get">
                <input type="text" name="query" placeholder="Search..." class="form-control">
                <button type="submit" class="btn"><i class="bi bi-search"></i></button>
            </form>
            <div class="d-flex align-items-center">
                @auth
                <div class="flex-grow-1 d-flex align-items-center justify-content-center me-4">
                    <div class="position-relative ms-4">
                        <a href="#" id="likesToggle" class="btn rounded-circle p-2 position-relative">
                            <i class="bi bi-heart fs-5 text-danger"></i>
                            @if($likesCount > 0)
                            <span class="badge bg-danger text-white position-absolute top-0 start-100 translate-middle p-1 small rounded-circle" style="font-size: 0.7rem; min-width: 18px;">
                                {{ $likesCount }}
                            </span>
                            @endif
                        </a>
                        <div id="likesDropdown" class="dropdown-menu shadow" style="display: none; right: 0; top: 110%; min-width: 250px; position: absolute; z-index: 1000;">
                            <ul class="list-unstyled m-0">
                                @forelse($likesOnMyProjects as $like)
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="{{ route('project.details', $like->project->id) }}">
                                        {{ $like->user->name }} liked your project <strong>{{ $like->project->title }}</strong>
                                    </a>
                                </li>
                                @empty
                                <li class="text-center text-muted p-2">No likes yet</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="position-relative ms-4">
                        <a href="#" id="notificationToggle" class="btn rounded-circle p-2 position-relative">
                            <i class="bi bi-chat fs-5 text-dark"></i>
                            @if($unreadUsersCount > 0)
                            <span class="badge bg-danger text-white position-absolute top-0 start-100 translate-middle p-1 small rounded-circle" style="font-size: 0.7rem; min-width: 18px;">
                                {{ $unreadUsersCount }}
                            </span>
                            @endif
                        </a>
                        <div id="notificationsDropdown" class="dropdown-menu shadow" style="display: none; right: 0; top: 110%; min-width: 200px; position: absolute; z-index: 1000;">
                            <ul class="list-unstyled m-0">
                                @forelse($unreadUsersDetails as $user)
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="{{ route('chat.index', $user->id) }}">
                                        {{ $user->name }} sent you a message
                                    </a>
                                </li>
                                @empty
                                <li class="text-center text-muted p-2">No new messages</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div>
                    <a href="{{ route('subecribtion') }}" class="btn ms-4 rounded-pill px-4 py-2" style=" color: white; background-color: black;">Go Pro</a>
                    </div class="position-relative ms-4">
                </div>
                <a href="{{ route('profile', Auth::user()->id) }}"
                    class="btn rounded-pill px-2 me-5 py-2 profile-menu-toggle" style="color: white;">
                    <img src="{{ $profileimage }}"
                        alt="Profile Image" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                </a>
                <div class="profile-menu" id="profileMenu">
                    <a href="{{ route('usersprofile.edit', Auth::user()->id) }}" class="text-start text-dark"> <i
                            class="bi bi-pencil-fill"></i> manage Profile</a>
                    <hr>
                    <a href="{{ route('profile', Auth::user()->id) }}" class="text-start text-dark"><i class="bi bi-person"></i> show profile</a>
                    <hr>
                    <form id="logout-form" action="{{ route('logoutusers') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="btn ms-4 rounded-pill px-4 py-2" style=""
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </div>
                @else
                <a href="{{ route('login') }}" class="btn ms-4 rounded-pill px-4 py-2" style=" color: white; background-color: black;">Login</a>
                @endauth
            </div>
        </div>
    </div>
    <div class="nav-wrap">
        <div class="container d-flex justify-content-center position-relative">
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('category') }}"
                            class="{{ Request::is('category') ? 'active' : '' }}">Category</a></li>
                            @auth
                    <li><a href="{{ route('add.project') }}"
                            class="{{ Request::is('add-project') ? 'active' : '' }}">Add Project</a></li>
                            @endauth
                    <li><a href="{{ route('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
    <script>
        document.querySelector('.profile-menu-toggle').addEventListener('click', function(event) {
            event.preventDefault();
            const menu = document.getElementById('profileMenu');
            menu.classList.toggle('show');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bellIcon = document.getElementById('notificationToggle');
            const dropdown = document.getElementById('notificationsDropdown');

            bellIcon.addEventListener('click', function(event) {
                event.preventDefault();
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', function(e) {
                if (!bellIcon.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeIcon = document.getElementById('likesToggle');
            const likeDropdown = document.getElementById('likesDropdown');
            const likeBadge = likeIcon.querySelector('.badge');

            if (localStorage.getItem('likeBadgeHidden') === 'true') {
                if (likeBadge) {
                    likeBadge.style.display = 'none';
                }
                likeIcon.querySelector('i').classList.remove('text-danger');
            }

            likeIcon.addEventListener('click', function(event) {
                event.preventDefault();

                if (likeBadge) {
                    likeBadge.style.display = 'none';
                }

                likeIcon.querySelector('i').classList.remove('text-danger');

                localStorage.setItem('likeBadgeHidden', 'true');

                likeDropdown.style.display = likeDropdown.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', function(e) {
                if (!likeIcon.contains(e.target) && !likeDropdown.contains(e.target)) {
                    likeDropdown.style.display = 'none';
                }
            });
        });
    </script>
</header>