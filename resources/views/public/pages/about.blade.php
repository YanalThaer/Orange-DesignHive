@extends('layouts.public')
@section('title', 'DesignHive | About Us')
@section('content')
<main class="main">
  <div class="page-title">
    <div class="title-wrapper">
      <h1>About</h1>
      <p>Welcome to our creative space where designers from all over the world come together to showcase their work, collaborate, and inspire each other.</p>
    </div>
  </div>
  <section id="about" class="about section ">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <span class="section-badge"><i class="bi bi-info-circle"></i> About Us</span>
      <div class="row">
        <div class="col-lg-6">
          <h2 class="about-title">Bringing Creatives Together</h2>
          <p class="about-description">Our platform connects designers from various fields, allowing them to share their work, get feedback, and form collaborations that elevate their skills and career opportunities.</p>
        </div>
        <div class="col-lg-6">
          <p class="about-text">We believe that creativity thrives when people collaborate. That’s why our platform is designed to empower designers to connect, share their work, and build lasting relationships with like-minded professionals.</p>
          <p class="about-text">Whether you're a graphic designer, UI/UX designer, or working in any design field, our community is here to support and challenge you in your creative journey.</p>
        </div>
      </div>
      <div class="row features-boxes gy-4 mt-3">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="feature-box">
            <div class="icon-box">
              <i class="bi bi-pencil"></i>
            </div>
            <h3><a href="#" class="stretched-link">Showcase Your Work</a></h3>
            <p>Share your best designs with the community and get the recognition you deserve. Your portfolio is your personal brand.</p>
          </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="feature-box">
            <div class="icon-box">
              <i class="bi bi-chat-left-text"></i>
            </div>
            <h3><a href="#" class="stretched-link">Engage with Other Designers</a></h3>
            <p>Connect with other designers, give feedback, and participate in discussions that expand your knowledge and networks.</p>
          </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
          <div class="feature-box">
            <div class="icon-box">
              <i class="bi bi-briefcase"></i>
            </div>
            <h3><a href="#" class="stretched-link">Collaborate on Projects</a></h3>
            <p>Work with other designers on projects, whether it's for personal or professional development. Collaboration can lead to new opportunities.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- <section id="team" class="team section light-background">
    <div class="container section-title" data-aos="fade-up">
      <h2>Our Designers</h2>
      <div><span>Meet Our</span> <span class="description-title">Creative Team</span></div>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <div class="team-member d-flex">
            <div class="member-img">
              <img src="assets/img/person/person-m-7.webp" class="img-fluid" alt="" loading="lazy">
            </div>
            <div class="member-info flex-grow-1">
              <h4>Walter White</h4>
              <span>Chief Design Officer</span>
              <p>With years of experience in the design industry, Walter brings fresh perspectives and creative strategies to the table.</p>
              <div class="social">
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
          <div class="team-member d-flex">
            <div class="member-img">
              <img src="assets/img/person/person-f-8.webp" class="img-fluid" alt="" loading="lazy">
            </div>
            <div class="member-info flex-grow-1">
              <h4>Sarah Jhonson</h4>
              <span>Product Designer</span>
              <p>Sarah specializes in creating user-centric designs, ensuring a balance between functionality and aesthetics in every project.</p>
              <div class="social">
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
          <div class="team-member d-flex">
            <div class="member-img">
              <img src="assets/img/person/person-m-6.webp" class="img-fluid" alt="" loading="lazy">
            </div>
            <div class="member-info flex-grow-1">
              <h4>William Anderson</h4>
              <span>UI/UX Designer</span>
              <p>William’s work bridges the gap between aesthetics and user experience, creating seamless designs that are both functional and engaging.</p>
              <div class="social">
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
          <div class="team-member d-flex">
            <div class="member-img">
              <img src="assets/img/person/person-f-4.webp" class="img-fluid" alt="" loading="lazy">
            </div>
            <div class="member-info flex-grow-1">
              <h4>Amanda Jepson</h4>
              <span>Illustrator</span>
              <p>Amanda brings illustrations to life, creating unique artwork that resonates with audiences and tells powerful stories.</p>
              <div class="social">
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
          <div class="team-member d-flex">
            <div class="member-img">
              <img src="assets/img/person/person-m-12.webp" class="img-fluid" alt="" loading="lazy">
            </div>
            <div class="member-info flex-grow-1">
              <h4>Brian Doe</h4>
              <span>Creative Director</span>
              <p>Brian excels at overseeing creative projects from concept to execution, always ensuring high-quality design output.</p>
              <div class="social">
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
          <div class="team-member d-flex">
            <div class="member-img">
              <img src="assets/img/person/person-f-9.webp" class="img-fluid" alt="" loading="lazy">
            </div>
            <div class="member-info flex-grow-1">
              <h4>Josepha Palas</h4>
              <span>Motion Designer</span>
              <p>Josepha brings designs to life with animation and motion graphics that captivate and engage audiences.</p>
              <div class="social">
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-behance"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
</main>
@endsection