
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
     })
    
    
$("#btnNuevo").click(function(){
    $("#formNuevaAsesoria").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Asesoria");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
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
    var respuesta = confirm("¿Está seguro que desea dar de baja la asesoria: "+Materia+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, AsesoriaAltaID:AsesoriaAltaID},
            success: function(){
                $(fila).fadeOut(200, function () {
                    table
                        .row($fila)
                        .fnDeleteRow()
                        .draw();                    
                });         
            }
            
        });
    }
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
    var respuesta = confirm("¿Darse se alta en la asesoria: "+Materia+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, AsesoriaDatoID:AsesoriaDatoID}
            // success: function(){
            //     tablaPersonas.row(fila.parents('tr')).remove().draw();
            // }
        });
    }   
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
    
$("#formNuevaAsesoria").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    pais = $.trim($("#pais").val());
    edad = $.trim($("#edad").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, pais:pais, edad:edad, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            pais = data[0].pais;
            edad = data[0].edad;
            if(opcion == 1){tablaPersonas.row.add([id,nombre,pais,edad]).draw();}
            else{tablaPersonas.row(fila).data([id,nombre,pais,edad]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});