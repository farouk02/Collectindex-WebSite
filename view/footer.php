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
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
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
    $("#counter_num").val(bu.getAttribute("data"));

    $("#code_client").val(bu.getAttribute("code_client"));
    $("#address").val(bu.getAttribute("address"));
    $("#old_index").val(bu.getAttribute("old_index"));
    $("#status").val(bu.getAttribute("status"));

    if (bu.getAttribute("status") == 1) {
      $("#status1").prop("checked", true);
    }
    if (bu.getAttribute("status") == 0) {
      $("#status2").prop("checked", true);
    }

    $('#mounth').val(bu.getAttribute("mounth"));
    $('#start_day').val(bu.getAttribute("start_day"));
    $('#end_day').val(bu.getAttribute("end_day"));

    $("#firstname").val(bu.getAttribute("firstname"));
    $("#lastname").val(bu.getAttribute("lastname"));
    $("#username").val(bu.getAttribute("username"));
    $("#password").val(bu.getAttribute("password"));
  }

  function delM(bu) {
    $("#delModal").modal();
    $("#disDelCodeClient").val(bu.getAttribute("data"));
  }

  $(function() {
    var current = location.pathname;
    $('#main-menu li a').each(function() {
      var $this = $(this);
      // if the current path is like this link, make it active
      if ($this.attr('href').indexOf(current) !== -1) {
        $this.addClass('active-menu');
      }
    })
  })
</script>
<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>
<script src="assets/js/custom.js"></script>
</body>


</html>