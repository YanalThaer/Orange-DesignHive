@extends('layouts.public')
@section('title', 'DesignHive | Chat')
@section('content')
@php
$profilePicture = $receiver->profile->profile_picture ?? '';
if (empty($profilePicture)) {
$imagePath = asset('assets/img/person/person-f-7.webp');
} elseif (Str::startsWith($profilePicture, ['http://', 'https://'])) {
$imagePath = $profilePicture;
} else {
$imagePath = asset($profilePicture);
}
$usernew = Auth::user()->load('profile');
$profileimage = $usernew->profile->profile_picture;
if (empty($profileimage)) {
$profileimage = asset('assets/img/person/person-f-7.webp');
} else {
$profileimage = Str::startsWith($profileimage, ['http://', 'https://']) ? $profileimage : asset($profileimage);
}
@endphp
<div id="auth-user-id" data-id="{{ Auth::user()->id }}" style="display:none;"></div>
<div id="receiver-name" data-name="{{ json_encode($receiver->name) }}" style="display:none;"></div>
<div style="background-color: white;">
    <div class="container p-3">
        <div class="row">
            <div class="col-md-3 border-0 shadow d-flex flex-column" style="height: 80vh; background-color: #fff; border-radius: 30px; padding:10px 30px;"> <!-- تغيير الخلفية إلى أبيض -->
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input class="form-control border-0" type="search" placeholder="Search" aria-label="Search">
                        </div>
                    </div>
                    <div class="col-12 p-0 flex-grow-1" style="overflow-y: auto; max-height: calc(80vh - 60px);">
                        @foreach ($chatUsers as $user)
                        @php
                        $pic = $user->profile->profile_picture ?? '';
                        $pic = $pic ? (Str::startsWith($pic, ['http://', 'https://']) ? $pic : asset($pic)) : asset('assets/img/person/person-f-7.webp');
                        @endphp
                        <a href="{{ route('chat.index', ['receiver_id' => $user->id]) }}" class="text-decoration-none text-dark">
                            <div class="d-flex align-items-center p-2 border-bottom chat-user-item" style="cursor: pointer; padding: 10px; background-color: white; border-radius: 10px; margin-bottom: 10px;"> <!-- تغيير الخلفية إلى لون فاتح -->
                                <img src="{{ $pic }}" class="rounded-circle me-2" width="40" height="40" alt="User Avatar">
                                <div>
                                    <strong>{{ $user->name }}</strong>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8 ms-5  shadow border-0 d-flex flex-column" style="height: 80vh; border-radius: 30px; background-color: #fff;"> <!-- تغيير الخلفية إلى أبيض -->
                <div class="row p-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ $imagePath }}"
                                    class="rounded-circle border border-3 border-light me-3" width="50" height="50"
                                    alt="User Avatar">
                                <div class="d-flex flex-column">
                                    <p class="fw-bold mb-0">{{ $receiver->name ?? 'No Name' }}</p>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 mt-2">
                    </div>
                </div>
                <div class="flex-grow-1 p-3" id="chat-box" style="overflow-y: auto; max-height: calc(80vh - 120px);">
                    @foreach ($messages as $message)
                    <div class="d-flex {{ $message->sender_id == auth()->id() ? 'align-items-start justify-content-end' : 'align-items-start' }}">
                        @if ($message->sender_id != auth()->id())
                        <img src="{{ $imagePath }}" class="rounded-circle me-2"
                            width="40" height="40" alt="User Avatar">
                        @endif
                        <div class="p-3 rounded-3  border-0 shadow mt-4" style="max-width: 60%;">
                            <p class="mb-0">{{ $message->message }}</p>
                        </div>
                        @if ($message->sender_id == auth()->id())
                        <img src="{{ $profileimage }}" class="rounded-circle ms-2"
                            width="40" height="40" alt="User Avatar">
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="p-3 border-top ">
                    <form id="chat-form">
                        @csrf
                        <input type="hidden" id="receiver_id" value="{{ $receiver->id }}">
                        <div class="input-group">
                            <button class="btn border-0" type="button"
                                onclick="document.getElementById('fileInput').click();">
                                <i class="bi bi-paperclip" style="font-size: 1.2rem; color: #9f6ff1;"></i>
                            </button>
                            <input type="file" id="fileInput" style="display: none;"
                                accept="image/*, .pdf, .doc, .docx">
                            <input type="text" class="form-control border-0" placeholder="Type a message..." id="message" required>
                            <button class="btn rounded-pill" type="submit"
                                style="background-color: #9f6ff1; color: white;">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </form>
                    <div id="attachmentPreview" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="auth-user-id" data-id="{{ Auth::user()->id }}" style="display:none;"></div>
<div id="auth-user-image" data-image="{{ $profileimage }}" style="display:none;"></div>
<div id="auth-receiver-image" data-image="{{ $imagePath }}" style="display:none;"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let authUserId = $('#auth-user-id').data('id');
        let authUserImage = $('#auth-user-image').data('image');
        let receiverName = $('#receiver-name').data('name');
        let receiverImage = $('#auth-receiver-image').data('image');

        function loadMessages() {
            $.ajax({
                url: "{{ route('chat.fetch', $receiver->id) }}",
                method: "GET",
                success: function(response) {
                    let messagesHtml = "";
                    response.messages.forEach(msg => {
                        let isOwn = msg.sender_id == authUserId;
                        messagesHtml += `
                        <div class="d-flex ${isOwn ? 'align-items-start justify-content-end' : 'align-items-start'}">
                            ${!isOwn ? `<img src='${receiverImage}' class='rounded-circle ms-2' width='40' height='40' alt='User Avatar'>` : ''}
                            <div class="p-3 rounded-3  border-0 shadow mt-4" style="max-width: 60%;">
                                <p class="mb-0">${msg.message}</p>
                            </div>
                            ${isOwn ? `<img src='${authUserImage}' class='rounded-circle ms-2' width='40' height='40' alt='User Avatar'>` : ''}
                        </div>`;
                    });
                    $('#chat-box').html(messagesHtml);
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                }
            });
        }

        setInterval(loadMessages, 3000);

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();
            let message = $('#message').val();
            $.ajax({
                url: "{{ route('chat.send') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    receiver_id: $('#receiver_id').val(),
                    message: message
                },
                success: function(response) {
                    if (response.success) {
                        $('#message').val('');
                        loadMessages();
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        });
    });
</script>
@endsection