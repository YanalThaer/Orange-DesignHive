@extends('layouts.public')
@section('title', 'DesignHive | Edit Profile')
@section('content')
<main class="main mb-3">
    @php
    $imagePath = $user->profile->profile_picture ?? null;
    if (!$imagePath) {
    // null أو فارغة
    $imagePath = asset('assets/img/person/person-f-7.webp');
    } elseif (Str::startsWith($imagePath, ['http://', 'https://'])) {
    $imagePath = $imagePath; // URL خارجي
    } else {
    // مخزنة في مجلد public
    $imagePath = asset($imagePath);
    }
    @endphp
    <section class="section container container-design">
        <div class="d-flex align-items-center mb-4">
            <div class="text-white d-flex align-items-center justify-content-center">
                <img src="{{ $imagePath }}"
                    class="rounded-circle" style="width: 50px; height: 50px;" alt="">
            </div>
            <div class="ms-3">
                <h4 class="mb-0">{{ $user->name }}</h4>
                <small class="text-muted">Update your username and manage your account</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" data-target="edit-profile">Edit Profile</a></li>
                    <li class="nav-item"><a class="nav-link" data-target="password">Password</a></li>
                    <li class="nav-item"><a class="nav-link" data-target="social">Social Profiles</a></li>
                    <li class="nav-item delete-account mt-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Account</li>
                </ul>
            </div>
            <div class="col-md-8">
                {{-- Edit Profile --}}
                <div id="edit-profile" class="content-section">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-success">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('usersprofile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="profile">
                        <div class="text-white d-flex align-items-center">
                            <img id="profileImage" src="{{ $imagePath }}" class="rounded-circle" style="width: 50px; height: 50px;" alt="">
                            <button class="btn btn-dark btn-sm ms-3 mt-2" id="uploadButton">Change Photo</button>
                            <input type="file" id="fileInput" name="profile_picture" class="d-none" accept="image/*">
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="{{ old('location', $user->profile->location ?? '') }}">
                        </div>
                        <div class="bio-container mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="bio" class="form-label">Bio</label>
                                <span class="char-count text-muted"><span id="charCount">{{ strlen(old('bio', $user->profile->bio ?? '')) }}</span>/1024</span>
                            </div>
                            <textarea id="bio" class="form-control" name="bio" maxlength="1024" placeholder="Write something about yourself...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                            <p class="bio-description">Brief description for your profile. URLs are hyperlinked.</p>
                        </div>

                        <button type="submit" class="btn btn-save">Save Changes</button>
                        <a href="{{ route('home') }}" class="btn btn-cancel ms-2">Cancel</a>
                    </form>
                </div>
                {{-- Password --}}
                <div id="password" class="content-section" style="display: none;">
                    <h4>Change Password</h4>
                    <form method="POST" action="{{ route('usersprofile.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                            @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control">
                            @error('new_password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                            @error('new_password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-save">Update Password</button>
                    </form>

                </div>
                {{-- Social --}}
                <div id="social" class="content-section" style="display: none;">
                    <h4>Social Profiles</h4>
                    <form method="POST" action="{{ route('usersprofile.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="social">
                        <div class="mb-3">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $user->profile->facebook ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $user->profile->twitter ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $user->profile->linkedin ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $user->profile->instagram ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-save">Update Social Links</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('usersprofile.destroy', auth()->user()->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete your account? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".content-section").hide();
        $("#edit-profile").show();

        $(".nav-link").click(function() {
            $(".nav-link").removeClass("active");
            $(this).addClass("active");

            $(".content-section").hide();
            $("#" + $(this).data("target")).fadeIn(200);
        });

        $("#uploadButton").click(function(e) {
            e.preventDefault();
            $("#fileInput").click();
        });

        $("#fileInput").change(function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#profileImage").attr("src", e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $("#bio").on("input", function() {
            $("#charCount").text($(this).val().length);
        });
    });
</script>
@endsection