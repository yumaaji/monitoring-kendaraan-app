<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.header')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      {{-- Topbar --}}
      @include('layouts.topbar')

      {{-- Sidebar --}}
      @include('layouts.sidebar')

      {{-- Main content --}}
      <div class="main-content">
        @yield('main-content')
      </div>

      {{-- Footer --}}
      @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('templates/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('templates/node_modules/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('templates/node_modules/owl.carousel/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('templates/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
  <script src="{{ asset('templates/node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <script src="{{ asset('templates/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('templates/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('templates/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('templates/assets/js/custom.js') }}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('templates/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('templates/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('templates/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
  
  <!-- Page Specific JS File -->
  <script src="{{ asset('templates/assets/js/page/index.js') }}"></script>
  <script src="{{ asset('templates/assets/js/page/modules-chartjs.js')}}"></script>
  <script src="{{ asset('templates/assets/js/page/modules-datatables.js') }}"></script>
  <script src="{{ asset('templates/assets/js/page/forms-advanced-forms.js') }}"></script>

</body>
</html>
