</div>
<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
  <p class="text-secondary mb-1 mb-md-0">Copyright © 2025 <a href="" target="_blank">NobleUI</a>.</p>
  <p class="text-secondary">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm" data-lucide="heart"></i></p>
</footer>    </div>
  </div>

  <div class="modal fade" id="editStockModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editStockModalContent">
      <!-- AJAX content will be injected here -->
    </div>
  </div>
</div>

   @if (session('success'))
    <div id="success-alert" class="alert-boxx alert alert-primary posup" role="alert" style="display: none;">
        <strong>{{ session('success') }}</strong>
    </div>

    <script>
        // Add this script at the end of your HTML body or within a script section
        $(document).ready(function () {
            $("#success-alert").fadeIn("slow");

            setTimeout(function () {
                $("#success-alert").fadeOut("slow");
            }, 5000); // 5000 milliseconds = 5 seconds
        });
    </script>
@endif


  @if (session('error'))
    <div id="danger-alert" class="alert-boxx alert alert-primary posup" role="alert" style="display: none;">
        <strong>{{ session('error') }}</strong>
    </div>

    <script>
        // Add this script at the end of your HTML body or within a script section
        $(document).ready(function () {
            $("#success-alert").fadeIn("slow");

            setTimeout(function () {
                $("#danger-alert").fadeOut("slow");
            }, 5000); // 5000 milliseconds = 5 seconds
        });
    </script>
@endif

    <!-- base js -->
    <link rel="modulepreload" href="/build/assets/app-T1DpEqax.js" />
    <script type="module" src="/build/assets/app-T1DpEqax.js"></script>    
    <script src="/build/plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/build/plugins/lucide/lucide.min.js"></script>
    <script src="/build/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- end base js -->

      <!-- plugin js -->
    <script src="/build/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="/build/plugins/apexcharts/apexcharts.min.js"></script>
    <link rel="modulepreload" href="/build/assets/template-SkarxsqJ.js" />
    <script type="module" src="/build/assets/template-SkarxsqJ.js"></script>  
    <link rel="modulepreload" href="/build/assets/dashboard-BsrMSOB0.js">
    <script type="module" src="/build/assets/dashboard-BsrMSOB0.js"></script>
  <script src="/js/custom.js"></script>
  </body>

<!-- Mirrored from nobleui.com/laravel/template/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Jul 2025 07:57:43 GMT -->
</html>