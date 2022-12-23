@include('administrator.header.header', $page)
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            @include('administrator.navbar.navbar')
          </div>
          <!-- / .main-navbar -->
          <div class="error">
            <div class="error__content">
              <h2>404</h2>
              <h3>Oops! Tidak ada data</h3>
              {{-- <p>There was a problem on our end. Please try again later.</p> --}}
              {{-- <button type="button" class="btn btn-accent btn-pill">&larr; Go Back</button> --}}
            </div>
            <!-- / .error_content -->
          </div>
          <!-- / .error -->
        </main>
      </div>
    </div>
    @include('administrator.footer.footer')