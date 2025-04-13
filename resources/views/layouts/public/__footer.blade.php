<footer class="footer bg-white border-top py-4">
  <div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 flex-wrap mb-3">
      <a href="{{ route('home') }}">
        <img src="{{ asset('assets/img/DesignHive.png') }}" alt="Logo" style="height: 40px;">
      </a>
      <ul class="list-unstyled d-flex flex-wrap gap-4 mb-0 fw-semibold">
        <li><a href="#" class="text-dark text-decoration-none">For designers</a></li>
        <li><a href="#" class="text-dark text-decoration-none">Inspiration</a></li>
        <li><a href="#" class="text-dark text-decoration-none">Advertising</a></li>
        <li><a href="{{ route('about') }}" class="text-dark text-decoration-none">About</a></li>
        <li><a href="{{ route('contact') }}" class="text-dark text-decoration-none">Support</a></li>
      </ul>
      <div class="d-flex gap-3 fs-5">
        <a href="#" class="text-dark"><i class="bi bi-twitter"></i></a>
        <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-dark"><i class="bi bi-pinterest"></i></a>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 text-muted small pt-3 ">
      <div>© 2025 DesignHive</div>
      <div class="d-flex flex-wrap gap-3">
        <a href="#" class="text-muted text-decoration-none">Designers</a>
        <a href="#" class="text-muted text-decoration-none">Freelancers</a>
        <a href="#" class="text-muted text-decoration-none">Tags</a>
        <a href="#" class="text-muted text-decoration-none">Places</a>
        <a href="#" class="text-muted text-decoration-none">Resources</a>
      </div>
    </div>
  </div>
</footer>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/home.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".like-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        let projectId = this.getAttribute("data-project-id");
        let likeIcon = this.querySelector("i");
        let likeCount = this.querySelector(".like-count");

        try {
          let response = await fetch("{{ route('toggle.like') }}", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
              project_id: projectId,
            }),
          });

          let data = await response.json();

          if (data.liked) {
            likeIcon.className = "bi bi-heart-fill fs-4 text-danger";
          } else {
            likeIcon.className = "bi bi-heart fs-4 text-muted";
          }

          likeCount.textContent = data.likes_count;
        } catch (error) {
          console.error("Error:", error);
        }
      });
    });
  });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBtn = document.querySelector('.btn[style*="background-color: #D8B6A4"]');
        const dropdownMenu = document.getElementById('notificationsDropdown');
        notificationBtn.addEventListener('click', function(e) {
            e.preventDefault();
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function(e) {
            if (!notificationBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>