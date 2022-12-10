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
                        <i class="fa fa-align-justify"></i> Viajes
                        <button type="button" @click="abrirModal('viaje','registrar')" class="btn btn-secondary">
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
                                      <option value="Descripcion">Descripcion</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarViaje(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarViaje(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                     <th>Opciones</th>
                                    <th>Conductor</th>
                                    <th>Placa</th>
                                    <th>Destino</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="viaje in arrayViaje" :key="viaje.id">
                                    <td>
                                        <button type="button" @click="abrirModal('viaje','actualizar',viaje)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="viaje.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarViaje(viaje.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarViaje(viaje.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                         <td v-text="viaje.conductor"></td>
                                        <td v-text="viaje.numero"></td>
                                        <td v-text="viaje.nombre"></td>
                                        <td v-text="viaje.descripcion"></td>
                                    <td>
                                        <div v-if="viaje.condicion">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Conductor</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idconductor">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="conductor in arrayConductor" :key="conductor.id" :value="conductor.id" v-text="conductor.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>

                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Placa Bus</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idbus">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="bus in arrayBus" :key="bus.id" :value="bus.id" v-text="bus.placa"></option>
                                        </select>                                        
                                    </div>
                                </div>
                          <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Destino</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idruta">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="ruta in arrayRuta" :key="ruta.id" :value="ruta.id" v-text="ruta.destino"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                                   
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="">                                        
                                    </div>
                                </div>

                            

                                 <div v-show="errorViaje" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjViaje" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarViaje()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarViaje()">Actualizar</button>
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
    /*import VueBarcode from 'vue-barcode';*/
    export default {
        data (){
            return {
                viaje: 0,
                idconductor : 0,
                idbus : 0,
                idruta : 0,
                conductor : '',
                numero : '',
                nombre : '',
                descripcion : '',
                arrayViaje : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorViaje : 0,
                errorMostrarMsjViaje : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'descripcion',
                buscar : '',
                arrayConductor :[],
                arrayBus :[],
                arrayRuta :[]
            }
        },
   /*     components: {
        'barcode': VueBarcode
    },*/
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
            listarViaje(page,buscar,criterio){
                let me=this;
                var url= '/viaje?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayViaje = respuesta.viajes.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cargarPdf(){
                window.open('/viaje/listarPdf','_blank');
            },
        selectRuta(){
                let me=this;
                var url= '/ruta/selectRuta';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRuta = respuesta.rutas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        selectConductor(){
                let me=this;
                var url= '/conductor/selectConductor';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayConductor = respuesta.conductores;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

        selectBus(){
                let me=this;
                var url= '/bus/selectBus';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayBus = respuesta.buses;
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
                me.listarViaje(page,buscar,criterio);
            },
            registrarViaje(){
                if (this.validarViaje()){
                    return;
                }
                let me = this;

                axios.post('/viaje/registrar',{
                    'idconductor': this.idconductor,
                    'idbus': this.idbus,
                    'idruta': this.idruta,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarViaje(1,'','descripcion');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarViaje(){
               if (this.validarViaje()){
                    return;
                }
                let me = this;

                axios.put('/viaje/actualizar',{
                    'idconductor': this.idconductor,
                    'idbus': this.idbus,
                    'idruta': this.idruta,
                    'descripcion': this.descripcion,
                    'id': this.viaje,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarViaje(1,'','descripcion');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },

            desactivarViaje(id){
               swal({
                title: 'Esta seguro de desactivar Viaje?',
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

                    axios.put('/viaje/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarViaje(1,'','descripcion');
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
            activarViaje(id){
               swal({
                title: 'Esta seguro de activar viaje?',
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

                    axios.put('/viaje/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarViaje(1,'','descripcion');
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

            validarViaje(){
                this.errorViaje=0;
                this.errorMostrarMsjViaje =[];

                if (this.idconductor==0) this.errorMostrarMsjViaje.push("Seleccione una Conductor.");
                if (this.idbus==0) this.errorMostrarMsjViaje.push("Seleccione una Bus.");
                if (this.idruta==0) this.errorMostrarMsjViaje.push("Seleccione una Destino.");
                if (!this.descripcion) this.errorMostrarMsjViaje.push(" no puede estar vacío la descripcion.");

                if (this.errorMostrarMsjViaje.length) this.errorViaje = 1;

                return this.errorViaje;
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idconductor= 0;
                this.idbus= 0;
                this.idruta= 0;
                this.descripcion = '';
                this.errorViaje=0  ;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "viaje":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Viaje';
                                this.idconductor=0;
                                this.conductor='';
                                this.idbus=0;
                                this.numero='';
                                this.idruta=0;
                                this.nombre='';                                
                                this.descripcion='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Bus';
                                this.tipoAccion=2;
                                this.viaje = data['id'];
                                this.idconductor = data['idconductor'];
                                this.idbus = data['idbus'];
                                this.idruta = data['idruta'];
                                this.descripcion = data['descripcion'];
                                break;
                            }
                        }
                    }
                }
                this.selectRuta();
                this.selectBus();
               this.selectConductor();
            }
        },
        mounted() {
            this.listarViaje(1,this.buscar,this.criterio);
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
