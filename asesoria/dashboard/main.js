
$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        // "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnInscribir'>Inscribirse</button><button class='btn btn-danger btnBorrar reload'>Borrar</button></div></div>"  
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnInscribir'>Inscribirse</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    tablaPersonas = $("#tablaPersonas1").DataTable({
        "columnDefs":[{
         "targets": -1,
         "data":null,
         // "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnInscribir'>Inscribirse</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
         "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrar '>Baja</button></div></div>"  
        }],
         
     "language": {
             "lengthMenu": "Mostrar _MENU_ registros",
             "zeroRecords": "No se encontraron resultados",
             "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
             "sSearch": "Buscar:",
             "oPaginate": {
                 "sFirst": "Primero",
                 "sLast":"Último",
                 "sNext":"Siguiente",
                 "sPrevious": "Anterior"
              },
              "sProcessing":"Procesando...",
         }
     });
     tablaPersonas = $("#tablaPersonas2").DataTable({
        "columnDefs":[{
         "targets": -1,
         "data":null,
         // "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnVer'>Inscribirse</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
         "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnVer '>Ver</button><button class='btn btn-info btnCerrar '>Cerrar</button></div></div>"  
        }],
         
     "language": {
             "lengthMenu": "Mostrar _MENU_ registros",
             "zeroRecords": "No se encontraron resultados",
             "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
             "sSearch": "Buscar:",
             "oPaginate": {
                 "sFirst": "Primero",
                 "sLast":"Último",
                 "sNext":"Siguiente",
                 "sPrevious": "Anterior"
              },
              "sProcessing":"Procesando...",
         }
     });
     
     tablaPersonas = $("#tablaPersonas3").DataTable({
        "columnDefs":[{
        //  "targets": 0,
         "data":null,
         // "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnVer'>Inscribirse</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
         //"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnVer '>Ver</button></div></div>"  
        }],
         
     "language": {
             "lengthMenu": "Mostrar _MENU_ registros",
             "zeroRecords": "No se encontraron resultados",
             "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
             "infoFiltered": "(filtrado de un total de _MAX_ registros)",
             "sSearch": "Buscar:",
             "oPaginate": {
                 "sFirst": "Primero",
                 "sLast":"Último",
                 "sNext":"Siguiente",
                 "sPrevious": "Anterior"
              },
              "sProcessing":"Procesando...",
         }
     });
    
    
$("#btnNuevo").click(function(){
    $("#formNuevaAsesoria").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Asesoria");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
    
});

$(document).on("click", ".btnCerrar", function(){
    // window.location="asesoriaDetalle.php";    
    fila = $(this).closest("tr");
    var cerrar = fila.find('td:eq(0)').text();
    opcion = 5;
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Estas a punto de cerrar una asesoria",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, cerrar:cerrar},
                success: function(){
                    Swal.fire(
                        'Correcto',
                        'Se a cerrado la asesoria',
                        'success'
                    ),setTimeout('location.reload()',3000);
                }        
            });
          
        }
      })
} );
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    AsesoriaDatoID = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    pais = fila.find('td:eq(2)').text();
    edad = parseInt(fila.find('td:eq(3)').text());
    
    $("#nombre").val(nombre);
    $("#pais").val(pais);
    $("#edad").val(edad);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    AsesoriaAltaID = parseInt($(this).closest("tr").find('td:eq(0)').text());
    Materia = $(this).closest("tr").find('td:eq(2)').text();
    opcion = 3 ;//borrar
    // var respuesta = confirm("¿Está seguro que desea dar de baja la asesoria: "+Materia+"?");
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Estas a punto de salir de la asesoria seleccionada",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, AsesoriaAltaID:AsesoriaAltaID},
                success: function(){
                    Swal.fire(
                        'Correcto',
                        'Se dio de baja',
                        'success'
                    ),setTimeout('location.reload()',3000);
                }        
            });
          
        }
      })
});

$(document).on("click", ".reload", function(){    
    window.location="index.php";
    });
//botón inscribir de asesoria
$(document).on("click", ".btnInscribir", function(){    
    fila = $(this);
    AsesoriaDatoID = parseInt($(this).closest("tr").find('td:eq(0)').text());
    Materia = $(this).closest("tr").find('td:eq(2)').text();
    opcion = 4 //alta en asesoria
    // var respuesta = confirm("¿Darse se alta en la asesoria: "+Materia+"?");
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Estas a punto de darse de alta en la asesoria seleccionada",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, AsesoriaDatoID:AsesoriaDatoID},
                success: function(){
                    Swal.fire(
                        'Correcto',
                        'Se dio de alta',
                        'success'
                    ),setTimeout('location.reload()',3000);
                }        
            });
          
        }
      })

});
function createCookie(name, value, days) {
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else {
      expires = "";
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
  }

$(document).on("click", ".btnVer", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    createCookie("id", id, "10");
        
    window.location="asesoriaDetalle.php"; 
});

$('#formPass').submit(function(e){    
    e.preventDefault();
    var pass = $.trim($("#pass").val());    
    var passConfirm =$.trim($("#passConfirm").val()); 
    opcion = 2;  

    if(pass.length == "" || passConfirm == ""){
        Swal.fire({
            icon:'warning',
            title:'Debe de ingresar una contraseña',
        });
        return false; 
      }else if(pass != passConfirm){
        Swal.fire({
            icon:'warning',
            title:'Las contraseñas no coinciden',
        });
      }else{
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Estas a punto de cambiar la contraseña",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cambiar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"bd/crud.php",
                    type:"POST",
                    datatype: "json",
                    data: {opcion:opcion,pass:pass}, 
                    success:function(data){               
                        if(data == "null"){
                            Swal.fire({
                                type:'error',
                                title:'Contraseña incorrecta',
                            });
                        }else{
                            Swal.fire(
                                'Cambiada!',
                                'La contraseña a cambiado.',
                                'success'
                            )//   .then((result) => {
                            //     if(result.value){
                            //         //window.location.href = "vistas/pag_inicio.php";
                            //         window.location.href = "dashboard/index.php";
                            //     }
                            // })
                            
                        }
                    }    
                 });
              
            }
          })
      }
    
});
    
// $("#formAlta").submit(function(e){
//     e.preventDefault();    
//     asesorID = $.trim($("#asesorID").val());
//     departamento = $.trim($("#departamento").val());
//     materia = $.trim($("#materia").val().charAt(0));
//     salon = $.trim($("#salon").val().charAt(0));
//     fecha = $.trim($("#fecha").val());
//     horai = $.trim($("#horai").val());
//     horaf = $.trim($("#horaf").val());
//     opcion = 1;
//     $.ajax({
//         url: "bd/crud.php",
//         type: "POST",
//         dataType: "json",
//         data: {asesorID:asesorID, materia:materia, salon:salon, fecha:fecha,horai:horai,horaf:horaf,opcion:opcion},
//         success: function(){  
            
//         }        
//     });
//     $("#modalCRUD").modal("hide");    
    
// });    


$("#formAlta").submit(function(e){
    e.preventDefault();    
    asesorID = $.trim($("#asesorID").val());
    departamento = $.trim($("#departamento").val());
    materia = $.trim($("#materia").val().charAt(0));
    salon = $.trim($("#salon").val().charAt(0));
    fecha = $.trim($("#fecha").val());
    horai = $.trim($("#horai").val());
    horaf = $.trim($("#horaf").val());
    opcion = 1;
    if(materia.length == "" || salon == ""|| fecha == "" || horai == ""|| horaf == ""){
        Swal.fire({
            icon:'warning',
            title:'Faltan datos por agregar',
        });
        return false; 
      }else{
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Estas a punto de alta una asesoria",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "bd/crud.php",
                    type: "POST",
                    dataType: "json",
                    data: {asesorID:asesorID, materia:materia, salon:salon, fecha:fecha,horai:horai,horaf:horaf,opcion:opcion},
                    success: function(){  
                        Swal.fire(
                            'Correcto',
                            'Se a dado de alta una asesoria.',
                            'success'
                        )                  
                    }        
                });
              
            }
          })
      } 
    
});    
    
});