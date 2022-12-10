@extends('auth.contenido')

@section('login')


    <section class="vh-100" style="background-color: #51d1f6;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col order-first  align-self-center col-md-4 col-lg-5 d-none d-md-block .col-sm-600">
                                <img width="900" height="900" src="img/perfil.jpg" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form class="form-horizontal was-validated" method="POST"
                                        action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #51d1f6;"></i>
                                            <span class="h1 fw-bold mb-0">Bolivar</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inciar Sesion</h5>

                                        <div class="form-group mb-3{{ $errors->has('usuario' ? 'is-invalid' : '') }}">
                                            <span class="input-group-addon"><i class="icon-user"> Usuario</i></span>
                                            <input type="text" value="{{ old('usuario') }}" name="usuario" id="usuario"
                                                class="form-control" placeholder="Usuario">
                                            {!! $errors->first('usuario', '<span class="invalid-feedback">:message</span>') !!}
                                        </div>

                                        <div class="form-group mb-4{{ $errors->has('password' ? 'is-invalid' : '') }}">
                                            <span class="input-group-addon"><i class="icon-lock"> Contraseña</i></span>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password">
                                            {!! $errors->first('password', '<span class="invalid-feedback">:message</span>') !!}
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit"
                                                class="btn btn-primary form-control ">Acceder</button>
                                        </div>
                                        <a class="small text-muted" href="#!">Recuperar Contraseña?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">No tienes una cuenta? <a href="#!"
                                                style="color: #393f81;">Registrate</a></p </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
