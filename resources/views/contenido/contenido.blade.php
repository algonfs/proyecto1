 @extends('index')

  @section('contenido')

   @if(Auth::check())
   
        @if (Auth::user()->idrol==1)
            <template v-if="menu==0">
                <h1></h1>
            </template>
            <template v-if="menu==1">
                <marca></marca>
            </template>
              <template v-if="menu==2">
                  <bus></bus>
            </template>
              <template v-if="menu==3">
                <conductor></conductor>
            </template>
              <template v-if="menu==4">
                <viaje></viaje>
            </template>
              <template v-if="menu==5">
                <ruta></ruta>
            </template>
              <template v-if="menu==7">
                <venta></venta>
            </template>
              <template v-if="menu==8">
                <cliente></cliente>
            </template>
              <template v-if="menu==9">
                   <user></user>
            </template>
              <template v-if="menu==10">
                  <rol ></rol>
            </template>
  

      @elseif (Auth::user()->idrol==2)
    >
          <template v-if="menu==4">
            <viaje></viaje>
        </template>
          <template v-if="menu==5">
            <ruta></ruta>
        </template>
          <template v-if="menu==7">
            <venta></venta>
        </template>
        <template v-if="menu==8">
          <cliente></cliente>
      </template>
            @else
        @endif
    @endif


    @endsection