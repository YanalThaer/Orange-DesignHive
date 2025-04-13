@extends('layouts.public')
@section('title', 'DesignHive | Contact Us')
@section('content')
<main class="main">
  <div class="page-title">
    <div class="title-wrapper">
      <h1>Contact</h1>
      <p>We are here to support your creative journey! Whether you have questions, need help, or want to connect with other designers, we're happy to hear from you.</p>
    </div>
  </div>
  <section id="contact" class="contact section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4 mb-5">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="info-card">
            <div class="icon-box">
              <i class="bi bi-geo-alt"></i>
            </div>
            <h3>Our Office</h3>
            <p>123 Design Street, Creative City, Jordan</p>
          </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="info-card">
            <div class="icon-box">
              <i class="bi bi-telephone"></i>
            </div>
            <h3>Contact Us</h3>
            <p>Phone: +962 (6) 123-4567<br>
              Email: support@designhub.jo</p>
          </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="info-card">
            <div class="icon-box">
              <i class="bi bi-clock"></i>
            </div>
            <h3>Working Hours</h3>
            <p>Monday - Friday: 9:00 - 18:00<br>
              Saturday: 10:00 - 16:00<br>
              Sunday: Closed</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{ route('store.contact') }}" method="post" role="form">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Your Name*" required="">
                  </div>
                </div>
                <div class="col-md-6 form-group">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Email Address*" required="">
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6 form-group">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                    <input type="text" class="form-control" name="phone" placeholder="Phone Number*" required="">
                  </div>
                </div>
                <div class="col-md-6 form-group">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-list"></i></span>
                    <select name="subject" class="form-control" required="">
                      <option value="">Select Service*</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category->name }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                    <textarea class="form-control" name="message" rows="6" placeholder="Write a message*" required=""></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection