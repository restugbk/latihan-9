        </section>
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        Created By <strong>Restu Fadhilah</strong>
      </div>
      <strong>Copyright &copy; 2021 <a href="https://www.instagram.com/i_technologi/" target="_blank">Tama Jagakarsa</a>.</strong> All rights
      reserved.
    </div>
  </footer>

</div>

<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="./assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="./assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="./assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="./assets/vendor/fastclick/lib/fastclick.js"></script>
<script src="./assets/js/adminlte.min.js"></script>
<script>
  $(function () {
    $('#datatable').DataTable()
    $('#datepicker').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
  })
</script>
</body>
</html>