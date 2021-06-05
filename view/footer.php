</div>
<!-- /. PAGE WRAPPER  -->

</div>
<!-- /. WRAPPER  -->


<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>

<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>

<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  $(document).ready(function() {
    $("#dataTables-example").dataTable();
  });

  function addM(bu) {
    $("#upModal").modal();
  }

  function upM(bu) {
    $("#upModal").modal();
    $("#disUpCodeClient").val(bu.getAttribute("data"));
    $("#upCodeClient").val(bu.getAttribute("data"));
    $("#firstname").val(bu.getAttribute("firstname"));
    $("#lastname").val(bu.getAttribute("lastname"));
    $("#username").val(bu.getAttribute("username"));
    $("#password").val(bu.getAttribute("password"));
  }

  function delM(bu) {
    $("#delModal").modal();
    $("#disDelCodeClient").val(bu.getAttribute("data"));
  }
</script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>
<script src="assets/js/custom.js"></script>
</body>


</html>