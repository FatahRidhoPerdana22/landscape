            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#" class="text-success">Your Site Name</a>, All Right Reserved. 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-success btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/chart/chart.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    
    <!--Datatables-->
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let table = new DataTable('#datatable');
    </script>
    <script>
        function confirmDialog() {
        return confirm('Apakah anda yakin akan menghapus data tanaman ini?')
        }
    </script>
    <script>
         $(document).ready(function () {
            $('.checkboxToggle').change(function () {
               var isChecked = $(this).prop('checked');
               var id_tanaman = $(this).data('id-tanaman');
            
               // Kirim status checkbox ke server CodeIgniter
               kirimStatusKeServer(id_tanaman, isChecked);
            });
        
            function kirimStatusKeServer(id_tanaman, isChecked) {
               // Kirim data ke server CodeIgniter menggunakan AJAX
               $.ajax({
                  type: 'POST',
                  url: '<?php echo base_url("controller/endpoint"); ?>',
                  data: { id_tanaman: id_tanaman, status: isChecked },
                  success: function (response) {
                     // Handle respons dari server CodeIgniter jika diperlukan
                     console.log(response);
                  },
                  error: function (error) {
                     // Handle kesalahan jika terjadi
                     console.log(error);
                  }
               });
            }
         });
    </script>
    <script>
        $('.sendData').click(function() {
            var id = $(this).data('id');
            var statusCell = $('.status-' + id);
                
            statusCell.text('Sending...');
                
            var url = '<?php echo base_url('send-data'); ?>?' +
                'id=' + encodeURIComponent(id) +
                '&nama_tanaman=' + encodeURIComponent(nama_tanaman) +
                '&min_ph=' + encodeURIComponent(min_ph) +
                '&max_ph=' + encodeURIComponent(max_ph) +
                '&min_lembab=' + encodeURIComponent(min_lembab) +
                '&max_lembab=' + encodeURIComponent(max_lembab);
                
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    statusCell.text('Success');
                    console.log(response);
                },
                error: function() {
                    statusCell.text('Failed');
                    alert('Terjadi kesalahan saat mengirim data.');
                }
            });
        });
    </script>
    <script>
        // Fungsi untuk mengirim permintaan AJAX ke server
        function realTime() {
            // Kirim permintaan AJAX ke method 'getDataSensor' di Controller Monitoring
            $.ajax({
                url: "<?php echo base_url('Monitoring/getDataSensor'); ?>",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    // Perbarui tampilan dengan data sensor yang terbaru
                    $("#valuePh").text(response.sensor_ph);
                    $("#valueLembab").text(response.sensor_lembab);
                    $("#timestamp").text(response.timestamp);
                    setTimeout(realTime, 2000)
                }
            });
        }

        // Panggil fungsi sendDataToServer setiap 5 detik
        realTime()
</script>
</body>

</html>