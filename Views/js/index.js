/**
 * Implementaacion de AJAX en PHP
 */
$(document).ready(function() {
  $('.alert').remove();
  $('#email').change(function() {
    const email = $(this).val();
    const values = new FormData();
    values.append('email', email);
    $.ajax({
      url: 'ajax/formAjax.php',
      method: 'POST',
      data: values,
      cache: false,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function(request) {
        if (request) {
          $('#email').val('');
          $('#email').parent().after(`
          <div class="alert alert-warning">El correo ya existe. Ingrese uno nuevo.</div>
          `);
        }
      }
    });
  });
});
