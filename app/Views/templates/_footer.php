<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="/assets/js/vendor.min.js"></script>

<!-- Plugins js-->
<script src="/assets/libs/flatpickr/flatpickr.min.js"></script>
<!--<script src="/assets/libs/apexcharts/apexcharts.min.js"></script>-->

<script src="/assets/libs/selectize/js/standalone/selectize.min.js"></script>

<!-- Dashboar 1 init js-->
<!--<script src="/assets/js/pages/dashboard-1.init.js"></script>-->

<!-- App js-->
<script src="/assets/js/app.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>



<script src="/assets/libs/select2/js/select2.min.js"></script>

<!-- Init js-->
<script src="/assets/js/pages/form-advanced.init.js"></script>

<!-- Plugins js -->
<script src="/assets/libs/quill/quill.min.js"></script>

<!-- Init js-->
<script src="/assets/js/pages/form-quilljs.init.js"></script>

<!-- Sweet Alerts js -->
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="/assets/js/pages/sweet-alerts.init.js"></script>

<!--Custom scripts-->

<script>
    $(window).load(function() {
        $(".se-pre-con").delay(3000).fadeOut('5000');

    });
</script>

<?=$this->renderSection('extra-scripts') ?>
</body>
</html>
