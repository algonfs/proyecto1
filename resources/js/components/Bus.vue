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
                        <i class="fa fa-align-justify"></i> Buses
                        <button type="button" @click="abrirModal('bus','registrar')" class="btn btn-secondary">
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
                                      <option value="placa">Placa</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarBus(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarBus(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                     <th>Opciones</th>
                                    <th>Marca</th>
                                    <th>Planta</th>
                                    <th>Placa</th>
                                    <th>Capacidad</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bus in arrayBus" :key="bus.id">
                                    <td>
                                        <button type="button" @click="abrirModal('bus','actualizar',bus)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="bus.codicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarBus(bus.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarBus(bus.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                         <td v-text="bus.nombre"></td>
                                        <td v-text="bus.planta"></td>
                                        <td v-text="bus.placa"></td>
                                        <td v-text="bus.capacidad"></td>
                                    <td>
                                        <div v-if="bus.codicion">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idmarca">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="marca in arrayMarca" :key="marca.id" :value="marca.id" v-text="marca.marca"></option>
                                        </select>                                        
                                    </div>
                                </div>
                            
                                

                              <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Planta</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="planta">
                                            <option value="0" disabled>Seleccione</option>
                                            <option value="1">1 planta</option>
                                            <option value="2">2 planta</option>
                                        </select>                                        
                                    </div>
                                </div>

                               
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Placa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="placa" class="form-control" placeholder="">                                        
                                    </div>
                                </div>

                              <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Capacidad</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="capacidad" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                            

                                 <div v-show="errorBus" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjBus" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarBus()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarBus()">Actualizar</button>
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
                bus_id: 0,
                idmarca : 0,
                nombre : '',
                planta : '',
                placa : '',
                capacidad : '',
                arrayBus : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorBus : 0,
                errorMostrarMsjBus : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'placa',
                buscar : '',
                arrayMarca :[]
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
            listarBus(page,buscar,criterio){
                let me=this;
                var url= '/bus?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayBus = respuesta.buses.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cargarPdf(){
                window.open('/bus/listarPdf','_blank');
            },
            selectMarca(){
                let me=this;
                var url= '/marca/selectMarca';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayMarca = respuesta.marcas;
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
                me.listarBus(page,buscar,criterio);
            },
            registrarBus(){
                if (this.validarBus()){
                    return;
                }
                
                let me = this;

                axios.post('/bus/registrar',{
                    'idmarca': this.idmarca,
                    'planta': this.planta,
                    'placa': this.placa,
                    'capacidad': this.capacidad
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarBus(1,'','placa');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarBus(){
               if (this.validarBus()){
                    return;
                }
                
                let me = this;

                axios.put('/bus/actualizar',{
                    'idmarca': this.idmarca,
                    'planta': this.planta,
                     'placa': this.placa,
                      'capacidad': this.capacidad,
                    'id': this.bus_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarBus(1,'','placa');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarBus(id){
               swal({
                title: 'Esta seguro de desactivar este Bus?',
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

                    axios.put('/bus/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarBus(1,'','placa');
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
            activarBus(id){
               swal({
                title: 'Esta seguro de activar este Bus?',
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

                    axios.put('/bus/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarBus(1,'','placa');
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

            validarBus(){
                this.errorBus=0;
                this.errorMostrarMsjBus =[];

                if (this.idmarca==0) this.errorMostrarMsjBus.push("Seleccione una Marca.");
                if (!this.planta) this.errorMostrarMsjBus.push(" no puede estar vacío el planta.");
                if (!this.placa) this.errorMostrarMsjBus.push(" no puede estar vacío el placa.");
                if (!this.capacidad ) this.errorMostrarMsjBus.push(" no puede estar vacío el capacidad.");
                if (this.capacidad > 80) this.errorMostrarMsjBus.push(" la capacidad no puede ser mas de 80.");
    
                if (this.errorMostrarMsjBus.length) this.errorBus = 1;

                return this.errorBus;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
               this.idmarca= 0;
                this.nombre = '';
                this.planta = '';
                this.placa = '';
                this.capacidad = '';
                this.errorBus=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "bus":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Bus';
                                this.idmarca=0;
                                this.nombre='';
                                this.planta='';  
                                this.placa='';   
                                this.capacidad='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Bus';
                                this.tipoAccion=2;
                                this.bus_id=data['id'];
                                this.idmarca=data['idmarca'];
                                this.planta=data['planta'];
                                this.placa=data['placa'];
                                this.capacidad=data['capacidad'];
                                break;
                            }
                        }
                    }
                }
                this.selectMarca();
            }
        },
        mounted() {
            this.listarBus(1,this.buscar,this.criterio);
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
