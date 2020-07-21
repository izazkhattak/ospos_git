// CODIGO PARA COPIAR INDEX A OTRO INDEX AUTOMATICO. EN DESARROLLO
     $(document).ready(function () {
          $("#7").keyup(function () {
              var value = $(this).val();
              $("#3").val(value);
          });
      });