function addCart(tt){
    $('#boxAdd_' + tt).fadeTo("slow", 1);
    $.post( "addprod.php", { data: tt }).done(function( ff ) {
      $('.carritoTotal').text('Cart ('+ff+')')
      $('#boxAdd_' + tt).fadeTo( "slow" , 0);
    });
  }

//Opciones ciudad
function cargaList(lista, valGeneral,campo){
      $('.' + campo).html('<option value="">--Seleccione--</option>');
      lista.forEach(element => {
          var extraDt = (valGeneral == element ? 'selected' : '');
          $('.' + campo).append('<option value="'+element+'" '+extraDt+'>'+ element.toUpperCase() +'</option>')
      })
  }
  $('.fPaisN').change(function(){
      $('.fCiudadN').empty()
      cargaList(buscaEstado($(this).val()),$(this).val(),'fEstadoN');
  })
  $('.fEstadoN').change(function(){
      $('.fCiudadN').empty()
      $('.fBarrio').empty()
      cargaList(buscaCiudad($(this).val()),$(this).val(),'fCiudadN');
  })
  $('.fPais').change(function(){
      $('.fCiudad').empty()
      $('.fBarrio').empty()
      cargaList(buscaEstado($(this).val()),$(this).val(),'fEstado');
  })
  $('.fEstado').change(function(){
      $('.fCiudad').empty()
      $('.fBarrio').empty()
      cargaList(buscaCiudad($(this).val()),$(this).val(),'fCiudad');
  })
  $('.fCiudad').change(function(){
      $('.fBarrio').empty()
      cargaList(buscaBarrio($(this).val()),$(this).val(),'fBarrio');
  })

  function buscaBarrio(dd){
      var rta = [];
      $(barrios).filter(function(i,n){
          if(n.desc === dd){
              if (!rta.includes(n.text)) {
                  rta.push(n.text);
              }
          }
      })
      return rta.sort();
  }
  function buscaCiudad(dd){
      var rta = [];
      $(data).filter(function(i,n){
          if(n.desc === dd){
              if (!rta.includes(n.city)) {
                  rta.push(n.city);
              }
          }
      })
      return rta.sort();
  }
  function buscaEstado(dd){
      var rta = [];
      $(data).filter(function(i,n){
          if(n.pais === dd){
              if (!rta.includes(n.desc)) {
                  rta.push(n.desc);
              }
          }
      })
      return rta.sort();
  }
  function buscaPais(){
      var rta = [];
      $(data).filter(function(i,n){
          if (!rta.includes(n.pais)) {
              rta.push(n.pais);
          }
      })
      return rta.sort();
  }

  //Contact Form

  $("#sendMsj").submit(function(e) {
    e.preventDefault();
    $('#sendBtMsj').html('Sending message. Please wait...');
    $.post( "mail.php", {
      name: $('#name').val(), 
      email: $('#email').val(), 
      message: $('#message').val()
    }).done(function( ff ) {
      $('.boxContact').text(ff)
    });
  });

  //Pay

  var handler = ePayco.checkout.configure({
        key: '4c0a5b1300e3b459c3612de80f3e639c',
        test: false
    });

  $("#gotoCheckOut").submit(function(e) {
        $('.toBuyBodyPainting').html('Cargando plataforma de pago por ePayCo...');
        e.preventDefault();
        var form = $(this);
        var actionUrl = '/checkout';

        var formData = form.serialize();
        var token = $('meta[name="csrf-token"]').attr('content');
        formData += '&_token=' + token;

        $.ajax({
        type: "POST",
        url: actionUrl,
        data: formData,
        success: function(data)
        {
            var dataepayco={
                  //Parametros compra (obligatorio)
                  name: $('#param_name').val(),
                  description: $('#param_desc').val(),
                  invoice: $('#param_inv').val(),
                  currency: "cop",
                  amount: $('#param_amount').val(),
                  tax_base: "0",
                  tax: "0",
                  country: "co",
                  lang: "es",

                  //Onpage="false" - Standard="true"
                  external: "true",

                  //Atributos opcionales
                  confirmation: "https://www.angelesurbanos.com/checkout",
                  response: "https://www.angelesurbanos.com/response",

                  //Atributos cliente
                  name_billing: $('#nombre').val(),
                  address_billing: $('#direccion').val(),
                  type_doc_billing: "cc",
                  mobilephone_billing: $('#telefono').val(),
                  number_doc_billing: $('#documento').val()
             }
             handler.open(dataepayco)
        }
    });
   });



   $('.cambiaCantidad').on('change', function() {
    var idForm = $(this).attr('idForm');
    var token = $('meta[name="csrf-token"]').attr('content'); // Obtener el token CSRF
    $('#form_' + idForm).append('<input type="hidden" name="_token" value="' + token + '">');
    $('#form_' + idForm).submit();
});