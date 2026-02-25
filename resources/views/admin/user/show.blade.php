@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Usuário')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card">
        <div class="card-body">
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
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <a
                data-bs-toggle="collapse"
                href="#editPhoto"
                role="button"
                aria-expanded="false"
                aria-controls="editPhoto"
              >
                <img
                  class="img-fluid rounded mt-3 mb-2"
                  src="{{ isset($user->profile_photo_path) ? asset($user->profile_photo_path) : asset('images/portrait/small/avatar-icon.png') }}"
                  height="110"
                  width="110"
                  alt="User avatar"
                  data-bs-toggle="tooltip" title="Editar Foto"
                />
              </a>
              <div class="collapse mb-2" id="editPhoto">
                <div class="d-flex p-1 border">
                  <form id="formChangePhoto" method="POST" action="{{ route('update-photo') }}"  enctype="multipart/form-data">
                    @csrf
                    <input type="text" value="{{ $user->id }}" id="user_photo" name="user_photo" hidden/>

                    <div class="row">
                      <div class="mb-2 col-md-12 ">
                        <label class="form-label" for="profile_photo">Alterar Foto de Perfil</label>
                        <div class="input-group ">
                          <input type="file" class="form-control" id="profile_photo" name="profile_photo" >
                        </div>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary me-2">Alterar Foto</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="user-info text-center">
                <h4>{{ isset($user->person) ? (isset($user->person->social_name) ? $user->person->social_name : ( isset($user->person->full_name) ? $user->person->full_name : $user->name ) ) : $user->name }}</h4>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-around my-2 pt-75">
            <div class="d-flex align-items-start me-2">
              <span class="badge bg-light-primary p-75 rounded">
                <i data-feather="check" class="font-medium-2"></i>
              </span>
              <div class="ms-75">
                <h4 class="mb-0">14/06/22</h4>
                <small>Ultimo login</small>
              </div>
            </div>
            <div class="d-flex align-items-start">
              <span class="badge bg-light-primary p-75 rounded">
                <i data-feather="briefcase" class="font-medium-2"></i>
              </span>
              <div class="ms-75">
                <h4 class="mb-0">126</h4>
                <small>Postagens</small>
              </div>
            </div>
          </div>
          <h4 class="fw-bolder border-bottom pb-50 mb-1">Detalhes</h4>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-75">
                <span class="fw-bolder me-25">Nome de Usuário:</span>
                <span>{{$user->name}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">E-mail de Cadastro:</span>
                <span>{{$user->email}}</span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Status:</span>
                <span class="badge bg-light-{{ isset($user->person->status) ? ( $user->person->status == 'active' ? 'success' : 'danger' ) : 'warning'}}">
                {{ isset($user->person->status) ? ( $user->person->status == 'active' ? 'Ativo' : 'Bloqueado' ) : '-'}}
                </span>
              </li>
              <li class="mb-75">
                <span class="fw-bolder me-25">Contato:</span>
                <span>
                  @if(isset($user->person->phones))
                    @php $i = 0; @endphp
                    @foreach($user->person->phones as $phone)
                      @if($i == 0)
                        @php $i = 1; @endphp
                        {{ $phone->phone }}
                      @else
                        @php $i = 0; @endphp
                        {{ ', ' . $phone }}
                      @endif
                    @endforeach
                  @else
                  {{'-'}}
                  @endif
                </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User menu e dados Start -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="sistem-tab-justified"
                data-bs-toggle="pill"
                href="#sistem-justified"
                aria-expanded="true"
                >Sistema</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="edit-tab-justified"
                data-bs-toggle="pill"
                href="#edit-justified"
                aria-expanded="false"
                >Editar</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="security-tab-justified"
                data-bs-toggle="pill"
                href="#security-justified"
                aria-expanded="false"
                >Segurança</a
              >
            </li>
          </ul>
          <div class="tab-content">
            <!-- Sistema -->
            <div role="tabpanel" class="tab-pane active" id="sistem-justified" aria-labelledby="sistem-tab-justified" aria-expanded="true" >
              <!-- Project table -->
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Lista de de Datas Agendadas</h4>
                </div>
                <div class="table-responsive">
                  <table class="table text-nowrap text-center">
                    <thead>
                      <tr>
                        <th>Agenda</th>
                        <th>Status</th>
                        <th>Agendado para</th>
                      </tr>
                    </thead>
                    <tbody>
                          <tr>
                            <td ><span class="fw-bolder">-</span></td>
                            <td ><span class="fw-bolder">-</span></td>
                            <td ><span class="fw-bolder">-</span></td>
                          </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /Project table -->

              <!-- Activity Timeline -->
              <div class="card">
                <h4 class="card-header">Linha do Tempo de Atividades</h4>
                <div class="card-body pt-1">
                  <ul class="timeline ms-50">

                  @if(isset($audits))
                    @foreach($audits as $audit)
                      <li class="timeline-item">
                        <span class="timeline-point timeline-point-indicator"></span>
                        <div class="timeline-event">
                          <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                            <h6>{{ $audit->auditable_type }}</h6>
                            <span class="timeline-event-time me-1">{{ $audit->event . ' - IP: ' . $audit->ip_address }}</span>
                          </div>
                          <p>{{ $audit->created_at }}</p>
                        </div>
                      </li>
                    @endforeach
                  @endif

                  </ul>
                </div>
              </div>
              <!-- /Activity Timeline -->
            </div>
            <!-- edição -->
            <div role="tabpanel" class="tab-pane" id="edit-justified" aria-labelledby="edit-tab-justified" aria-expanded="false" >
              <!-- Editar Informações do Usuário -->
              <div class="card">
                <h4 class="card-header">Editar Informações do Usuário</h4>
                <div class="card-body pt-1">
                  @if(isset($user->person))
                    <form id="editUserForm" method="POST" action="{{ route('pessoas.update', $user->person->id) }}" class="row gy-1 pt-75">
                      @csrf()
                      @method('PUT')
                      <input type="text" value="pf" name="personable_type" id="personable_type" hidden/>
                      <div class="col-12">
                        <label class="form-label" for="person_name">Nome Completo</label>
                        <input
                          type="text"
                          id="person_name"
                          name="person_name"
                          class="form-control"
                          placeholder="digite o nome"
                          value="{{ $user->person->full_name }}"
                        />
                      </div>
                      <div class="col-6">
                        <label class="form-label" for="social_name">Nome Social (apelido, alcunha, designação, etc)</label>
                        <input
                          type="text"
                          id="social_name"
                          name="social_name"
                          class="form-control"
                          placeholder="digite o nome social"
                          value="{{ $user->person->social_name }}"
                        />
                      </div>
                      @foreach($user->person->documents as $document)
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserEmail">{{ $document->document_type->type }}:</label>
                            <input type="number" class="form-control" name="documents[id][]" value="{{ $document->id }}"  hidden>
                            <input type="text" class="form-control" name="documents[document_type][]" value="{{ $document->document_type_id }}"  hidden>
                            <input type="text" class="form-control input-admin" value="{{ $document->document }}" id="{{ $document->document_type->type }}" name="documents[document][]">
                        </div>
                      @endforeach
                      @foreach($user->person->phones as $phone)
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="phone">Celular</label>
                          <input type="number" class="form-control" name="phones[id][]" value="{{ $phone->id }}" hidden>
                          <input
                            type="text"
                            id="{{ 'phone-' . $phone->id }}"
                            name="phones[phone][]"
                            class="form-control"
                            value="{{ $phone->phone }}"
                          />
                        </div>
                      @endforeach



                      <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                    <form method="POST" name="form-delete" action="{{ route('pessoas.destroy', $user->person->id) }}">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-danger"  style="position: relative; float: left;"
                          onclick="return confirm('Tem certeza que deseja deletar?');">Deletar
                        </button>
                    </form>
                    </div>
                  @endif
                </div>
              </div>
              <!-- /Editar Informações do Usuário -->
            </div>
            <!-- segurança -->
            <div class="tab-pane" id="security-justified" role="tabpanel" aria-labelledby="security-tab-justified" aria-expanded="false" >

              <!-- Change Password -->
              <div class="card">
                <h4 class="card-header">Alterar Senha</h4>
                <div class="card-body">
                  <form id="formChangePassword" method="POST" action="{{ route('update-password') }}">
                    @csrf
                    <input type="text" value="{{ $user->id }}" id="user_id" name="user_id" hidden/>

                    <div class="alert alert-warning mb-2" role="alert">
                      <h6 class="alert-heading">Garanta que estes requerimentos sejam atendidos.</h6>
                      <div class="alert-body fw-normal">Mínimo de 8 caracteres, letras maiúsculas, minúsculas e símbolo.</div>
                    </div>

                    <div class="row">
                      <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="password">Nova Senha</label>
                        <div class="input-group input-group-merge form-password-toggle">
                          <input
                            class="form-control"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          />
                          <span class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                          </span>
                        </div>
                      </div>

                      <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="password_confirmation">Confirmar Nova Senha</label>
                        <div class="input-group input-group-merge">
                          <input
                            class="form-control"
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          />
                          <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary me-2">Alterar Senha</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Change Email -->
              <div class="card">
                <h4 class="card-header">Alterar E-mail</h4>
                <div class="card-body">
                  <form id="formChangeEmail" method="POST" action="{{ route('update-email') }}">
                    @csrf
                    <input type="text" value="{{ $user->id }}" id="user" name="user" hidden/>

                    <div class="row">
                      <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="password">Novo E-mail</label>
                        <div class="input-group input-group-merge ">
                          <input
                            class="form-control"
                            type="email"
                            id="email"
                            name="email"
                          />
                          <span class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                          </span>
                        </div>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary me-2">Alterar E-mail</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!--/ Change Password -->
              <!--/ Change Password --><!-- two-step verification -->
              <div class="card">
                <div class="card-header border-bottom">
                  <h4 class="card-title">Autentificação de dois fatores</h4>
                </div>
                <div class="card-body my-2 py-25">
                  <form action="/user/two-factor-authentication" method="post">
                    @csrf
                      @if(auth()->user()->two_factor_secret)
                        @method('DELETE')
                        <p class="fw-bolder">A autentificação de dois fatores está ativada.</p>
                        <div class="mt-2 mb-2">
                          {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <div class="mt-2 mb-2">
                          <p>Lista de Códigos de Recuperação</p>
                          <ul>
                            @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                              <li>{{ $code }}</li>
                            @endforeach
                          </ul>
                        </div>
                        <button class="btn btn-primary">
                          Desativar autentificação de dois fatores
                        </button>
                      @else
                        <p class="fw-bolder">A autentificação de dois fatores ainda não está ativada.</p>
                        <p>
                        A autenticação de dois fatores adiciona uma camada adicional de segurança à sua conta,  <br />
                        exigindo mais do que apenas uma senha para fazer login. Saiba Mais.
                        </p>
                        <button class="btn btn-primary">
                          Ativar autentificação de dois fatores
                        </button>
                      @endif

                  </form>
                </div>
              </div>
              <!-- / two-step verification -->

              <!-- recent device -->
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Acessos Recentes</h4>
                </div>
                <div class="table-responsive">
                  <table class="table text-nowrap text-center">
                    <thead>
                      <tr>
                        <th class="text-start">BROWSER</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach($audits as $audit)
                        <tr>
                          <td class="text-start">
                            <div class="avatar me-25">
                              <img src="{{asset('images/icons/google-chrome.png')}}" alt="avatar" width="20" height="20" />
                            </div>
                            <span class="fw-bolder">{{ $audit->user_agent }}</span>
                          </td>
                        </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
              <!-- / recent device -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- User menu e dados End -->

  </div>
</section>

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  {{-- data table --}}
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
@endsection
