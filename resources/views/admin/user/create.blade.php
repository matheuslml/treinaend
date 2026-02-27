@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Criar Usuário')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="row">

    <!-- Register-->
    <div class="col-lg-12  ">
      <div class="card ">
        <div class="card-body ">
          <!-- Register-->
          <div class="col-lg-12 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            @include('flash::message')
              @if ($errors->any())
                <div class="alert alert-danger pb-2" role="alert">
                    <h4 class="alert-heading">Erros:</h4>
                    <div class="alert-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              @endif
              <form class="auth-register-form mt-2" action="{{ route('pessoas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                  <input type="text" name="personable_type" id="personable_type" value="pf" hidden />
                  <div class="content-header mb-2">
                        <h2 class="fw-bolder mb-75">Cadastrar Usuário no Sistema</h2>
                        <span>entre com os dados para login</span>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-1">
                      <label class="form-label" for="name">Nome Completo<strong>*</strong></label>
                      <input type="text" name="name" id="name" class="form-control" placeholder="nome de usuário" />
                    </div>
                    <div class="mb-1 col-md-12">
                      <label class="form-label" for="social_name">Nome Social (apelido, alcunha, designação, etc) <tag data-bs-toggle="tooltip" title="Nome com o qual a pessoa quer ser chamada"><i data-feather='info'></i></tag></label>
                      <input type="text" name="social_name" id="social_name" class="form-control" placeholder="Nome Sobrenome" />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for=cpf">CPF<strong>*</strong></label>
                      <input type="hidden" name="documents[document_type][]" value="1">
                      <input
                        type="text"
                        name="documents[document][]"
                        id="cpf"
                        class="form-control custom-delimiter-mask"
                        placeholder="999.999.999-99"
                      />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="email">E-mail<strong>*</strong></label>
                      <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                            placeholder="email@email.com"
                            aria-label="email"
                      />
                    </div>
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="email">Aluno ou Administrador do Sistema?<strong>*</strong></label>
                      <select class="select2 form-select" id="type" name="type">
                        <optgroup label="Selecione">
                            <option value="aluno" >Aluno</option>
                            <option value="administrador" >Administrador</option>
                        </optgroup>
                      </select>
                  </div>
                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="password">Senha<strong>*</strong><tag data-bs-toggle="tooltip" title="Utilize um senha FORTE com no Míniomo 8 Caracteres. contendo pelo menos 1 numero, 1 letra e 1 caracter especial"><i data-feather='info'></i></tag></label>
                      <div class="input-group input-group-merge form-password-toggle">
                        <input
                          type="password"
                          name="password"
                          id="password"
                          class="form-control"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                      </div>
                    </div>

                    <div class="col-md-6 mb-1">
                      <label class="form-label" for="confirm-password">Confirmar Senha<strong>*</strong><tag data-bs-toggle="tooltip" title="Utilize um senha FORTE com no Míniomo 8 Caracteres. contendo pelo menos 1 numero, 1 letra e 1 caracter especial"><i data-feather='info'></i></tag></label>
                      <div class="input-group input-group-merge form-password-toggle">
                        <input
                          type="password"
                          name="confirm_password"
                          id="confirm_password"
                          class="form-control"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                      </div>
                    </div>
                  </div>
                    <button class="btn btn-primary w-100 mt-2" type="submit" tabindex="5">Cadastrar</button>
              </form>
            </div>

          </div>
        <!-- /Register-->
        </div>
      </div>
    </div>

  </div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/address/address.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/departament/departament.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/auth-register.js'))}}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-input-mask.js')) }}"></script>
@endsection
