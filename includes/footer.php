<script src="dist/js/bootstrap.bundle.min.js"></script>

<!-- DATA TABLES -->
<script src="dist/js/jquery-3.5.1.js"></script>
<script src="dist/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#tabela').DataTable({
      paging: false,
      ordering: false,
      info: false,
    });
  });
</script>

<script>
  var tab = jQuery.noConflict();
  tab(document).ready(function() {
    tab('#tabela').DataTable({
      paging: false,
      ordering: false,
      info: false,
      "language": {
        "sProcessing": "Procurando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "NENHUM REGISTRO ENCONTRADO",
        "search": "",
        "info": "Mostrar _START_ até _END_ de _TOTAL_ registros",
        "infoEmpty": "Nenhum registro encontrado",
        "infoFiltered": "(filtrado de _MAX_ registros totais)",
        "searchPlaceholder": "Busca",
        "paginate": {
          "first": "Primeiro",
          "last": "Último",
          "next": "Próximo",
          "previous": "Anterior"
        },
      }
    });
  });

  var row = jQuery.noConflict();
  row(document).ready(function() {
    var table = row('#tabela').DataTable();

    row('#tabela tbody').on('click', 'tr', function() {
      row(this).toggleClass('selected');
    });

    row('#button').click(function() {
      alert(table.rows('.selected').data().length + ' row(s) selected');
    });
  });
</script>



<script type='text/javascript' src='dist/js/jquery.min.js'></script>
<script>
  $(window).on('load', function() {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
      'overflow': 'visible'
    });
  })
</script>

</body>

</html>