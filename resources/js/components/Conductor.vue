<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                     <i class="icon-user-follow"></i> Conductor
                        <button type="button" @click="abrirModal('conductor','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                              <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="cedula">Cedula</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarConductor(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarConductor(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>                                               
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Brevete</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="conductor in arrayConductor" :key="conductor.id">
                                    <td>
                                        <button type="button" @click="abrirModal('conductor','actualizar',conductor)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="conductor.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarCondutor(conductor.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarConductor(conductor.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="conductor.nombre"></td>
                                    <td v-text="conductor.cedula"></td>
                                    <td v-text="conductor.brevete"></td>
                                    <td v-text="conductor.direccion"></td>
                                    <td v-text="conductor.telefono"></td>
                                    <td>
                                        <div v-if="conductor.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de Conductor">     
                                    </div>
                                </div>
                                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cedula</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="cedula" class="form-control" placeholder="Numero de cedula">     
                                    </div>
                                </div>
                                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Brevete</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="brevete" class="form-control" >     
                                    </div>
                                </div>
                                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control">     
                                    </div>
                                </div>
                                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="telefono" class="form-control" >     
                                    </div>
                                </div>
                        



                                <div v-show="errorConductor" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjConductor" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarConductor()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarConductor()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data (){
            return {
                conductor_id: 0,
                nombre : '',
                cedula : '',
                brevete : '',
                direccion : '',
                telefono : '',
                arrayConductor: [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorConductor : 0,
                errorMostrarMsjConductor : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarConductor (page,buscar,criterio){
                let me=this;
                var url= '/conductor?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayConductor = respuesta.conductores.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarConductor(page,buscar,criterio);
            },
            registrarConductor(){
                if (this.validarConductor()){
                    return;
                }                
                let me = this;
                axios.post('/conductor/registrar',{
                   'nombre': this.nombre,
                    'cedula': this.cedula,
                    'brevete': this.brevete,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarConductor(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
                cargarPdf(){
                window.open('/conductor/listarPdf','_blank');
            },
            actualizarConductor(){
               if (this.validarConductor()){
                    return;
                }
                
                let me = this;

                axios.put('/conductor/actualizar',{
                    'nombre': this.nombre,
                    'cedula': this.cedula,
                    'brevete': this.brevete,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                    'id': this.conductor_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarConductor(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarCondutor(id){
               swal({
                title: 'Esta seguro de desactivar este Conductor?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/conductor/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarConductor(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarConductor(id){
               swal({
                title: 'Esta seguro de activar este Conductor.?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                   let me = this;

                    axios.put('/conductor/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarConductor(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    }); 
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarConductor(){
                this.errorConductor=0;
                this.errorMostrarMsjConductor =[];

                if (!this.nombre) this.errorMostrarMsjConductor.push("El nombre no puede estar vacío.");
                if (!this.cedula) this.errorMostrarMsjConductor.push("La Cedula  no puede estar vacío.");
                 if (this.cedula > 999999999) this.errorMostrarMsjConductor.push("No puede exceder a mas de 10 digitos la cedula.");
                 if (this.cedula < 9999) this.errorMostrarMsjConductor.push("No puede ser menor a 4 digitos la cedula.");
                if (!this.brevete) this.errorMostrarMsjConductor.push("El brevete  no puede estar vacío.");
                if (!this.direccion) this.errorMostrarMsjConductor.push("La direccion  no puede estar vacío.");
                if (!this.telefono) this.errorMostrarMsjConductor.push("El Telefono  no puede estar vacío.");
                if (this.telefono > 99999999) this.errorMostrarMsjConductor.push("No puede exceder a mas de 8 digitos el telefono.");
                 if (this.telefono < 9999999) this.errorMostrarMsjConductor.push("No puede ser a menos de 8 digitos el telefono.");
                if (this.errorMostrarMsjConductor.length) this.errorConductor = 1;
                return this.errorConductor;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.cedula='';
                this.brevete='';
                this.direccion='';
                this.telefono='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "conductor":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Conductor';
                                this.nombre ='';
                                this.cedula ='';
                                this.brevete ='';
                                this.direccion ='';
                                this.telefono=''; 
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Conductor';
                                this.tipoAccion=2;
                                this.conductor_id = data['id'];
                                this.nombre = data['nombre'];
                                this.cedula = data['cedula'];
                                this.brevete = data['brevete'];
                                this.direccion = data['direccion'];
                                this.telefono= data['telefono'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarConductor(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
