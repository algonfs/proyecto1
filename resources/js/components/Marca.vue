<template>

 <!-- Breadcrumb -->
  <main class="main">
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
</ol>
<div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Marcas
            <button type="button" @click="abrirModal('marca','registrar')" class="btn btn-secondary">
                <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control col-md-3" v-model="criterio">
                          <option value="marca">Nombre</option>
                        </select>
                        <input type="text" v-model="buscar" @keyup.enter="listarMarca(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                        <button type="submit" @click="listarMarca(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th>Marca</th>   
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="marca in arrayMarca" :key="marca.id">
                        <td>
                            <button type="button" @click="abrirModal('marca','actualizar',marca)" class="btn btn-warning btn-sm">
                              <i class="icon-pencil"></i>
                            </button> &nbsp;
                            <template v-if="marca.condicion">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarMarca(marca.id)">
                                    <i class="icon-trash"></i>
                                </button>
                            </template>
                            <template v-else>
                                <button type="button" class="btn btn-info btn-sm" @click="activarMarca(marca.id)">
                                    <i class="icon-check"></i>
                                </button>
                            </template>
                        </td>
                        <td v-text="marca.marca"></td>
                      
                        <td>
                            <div v-if="marca.condicion">
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
                  <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input type="text" v-model="marca" class="form-control" placeholder="Nombre de Marca">
                            
                        </div>
                    </div>   
                    <div v-show="errorMarca" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjMarca" :key="error" v-text="error">

                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMarca()">Guardar</button>
                <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMarca()">Actualizar</button>
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
                marca_id: 0,
                marca : '',
                
                arrayMarca : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMarca : 0,
                errorMostrarMsjMarca : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'marca',
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginaci??n
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
            listarMarca (page,buscar,criterio){
                let me=this;
                var url= '/marca?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMarca = respuesta.marcas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la p??gina actual
                me.pagination.current_page = page;
                //Envia la petici??n para visualizar la data de esa p??gina
                me.listarMarca(page,buscar,criterio);
            },
            registrarMarca(){
                if (this.validarMarca()){
                    return;
                }
                
                let me = this;

                axios.post('/marca/registrar',{
                    'marca': this.marca
               
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMarca(1,'','marca');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarMarca(){
               if (this.validarMarca()){
                    return;
                }
                
                let me = this;

                axios.put('/marca/actualizar',{
                    'marca': this.marca,
                  
                    'id': this.marca_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMarca(1,'','marca');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarMarca(id){
               swal({
                title: 'Esta seguro de desactivar est Marca?',
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

                    axios.put('/marca/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarMarca(1,'','marca');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con ??xito.',
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
            activarMarca(id){
               swal({
                title: 'Esta seguro de activar esta Marca?',
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

                    axios.put('/marca/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarMarca(1,'','marca');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con ??xito.',
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
            validarMarca(){
                this.errorMarca=0;
                this.errorMostrarMsjMarca =[];

                if (!this.marca) this.errorMostrarMsjMarca.push("La marca no puede estar vac??o.");

                if (this.errorMostrarMsjMarca.length) this.errorMarca = 1;

                return this.errorMarca;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.marca='';
              
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "marca":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Marca';
                                this.marca= '';
                              
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Marca';
                                this.tipoAccion=2;
                                this.marca_id=data['id'];
                                this.marca = data['marca'];
                               
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarMarca(1,this.buscar,this.criterio);
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
