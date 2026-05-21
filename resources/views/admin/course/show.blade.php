@extends('admin/layouts/contentLayoutMaster')

@section('title', 'matriculas do Site')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Editar Curso</h4>
        </div>
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
          <form class="form form-horizontal" method="POST" action="{{ route('cursos.update', $course_selected->id) }}" enctype="multipart/form-data">
            @csrf()
              @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="name">Nome<tag data-bs-toggle="tooltip" title="Nome do Disciplina"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="name" name="name" value="{{ $course_selected->name }}" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="acronym">Sigla<tag data-bs-toggle="tooltip" title="descrição"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="acronym" name="acronym" value="{{ $course_selected->acronym }}" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="order">Ordem<tag data-bs-toggle="tooltip" title="Valor do Pagamento em Real"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-lg">
                        <input type="number" class="touchspin" value="{{ $course_selected->order }}" id="order" name="order" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="grade">Nota<tag data-bs-toggle="tooltip" title="Valor do Pagamento em Real"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                    <div class="input-group input-group-lg">
                        <input type="number" class="touchspin" value="{{ $course_selected->grade }}" id="grade" name="grade" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="type">tipo <tag data-bs-toggle="tooltip" title=""><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <select class="select2 form-select" id="type" name="type">
                        <optgroup label="Selecione">
                            <option value="EAD" {{ $course_selected->type == 'EAD' ? 'selected' : '' }} >EAD</option>
                            <option value="PRESENCIAL" {{ $course_selected->type == 'PRESENCIAL' ? 'selected' : '' }} >PRESENCIAL</option>
                        </optgroup>
                      </select>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="payment_value">Valor<tag data-bs-toggle="tooltip" title="Valor"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control used-balance" placeholder="10,000.00" value="{{ str_replace('.',',', $course_selected->payment_value) }}" id="payment_value" name="payment_value" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                  <div class="mb-1 row">
                      <div class="col-sm-3">
                          <label class="col-form-label" for="certificate_file_view">
                              Ver PDF
                              <tag data-bs-toggle="tooltip" title="Arquivo PDF">
                                  <i data-feather='info'></i>
                              </tag>
                          </label>
                      </div>
                      <div class="col-sm-9">
                          <a href="{{ route('certificate.view', $course_selected->id) }}" target="_blank" class="btn btn-primary">
                              Abrir Certificado Salvo
                          </a>
                      </div>
                  </div>
              </div>

              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="certificate_file">PDF para editar<tag data-bs-toggle="tooltip" title="Imagem"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" id="certificate_file" name="certificate_file" >
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="image_card">Imagem do CARD<tag data-bs-toggle="tooltip" title="Imagem"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/courses/' . $course_selected->image_card)}}"
                        alt="avatar img"
                      />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="image_card">Imagem para editar<tag data-bs-toggle="tooltip" title="Imagem"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" id="image_card" name="image_card" >
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="image_conclusion">Imagem da Conclusão<tag data-bs-toggle="tooltip" title="Imagem"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/courses/' . $course_selected->image_conclusion)}}"
                        alt="avatar img"
                      />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="image_conclusion">Imagem da Conclusão para editar<tag data-bs-toggle="tooltip" title="Imagem"><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" id="image_conclusion" name="image_conclusion" >
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="status">Status <tag data-bs-toggle="tooltip" title=""><i data-feather='info'></i></tag></label>
                  </div>
                  <div class="col-sm-9">
                      <select class="select2 form-select" id="status" name="status">
                        <optgroup label="Selecione">
                            <option value="PUBLISHED" {{ $course_selected->status == 'PUBLISHED' ? 'selected' : '' }} >Publicado</option>
                            <option value="DRAFT" {{ $course_selected->status == 'DRAFT' ? 'selected' : '' }}>Editando</option>
                            <option value="BKDNEWREGISTRATION" {{ $course_selected->status == 'BKDNEWREGISTRATION' ? 'selected' : '' }} >Bloqueado para novas Matrículas</option>
                            <option value="BLOCKED" {{ $course_selected->status == 'BLOCKED' ? 'selected' : '' }} >Bloqueado</option>
                        </optgroup>
                      </select>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                </form>
                <form method="POST" name="form-delete" action="{{ route('cursos.destroy', $course_selected->id) }}">
                    @csrf()
                    @method('delete')
                    <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                      onclick="return confirm('Tem certeza que deseja deletar a Disciplina?');">Deletar
                    </button>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Disciplinas Cadastradas - Busca Avançada</h4>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($disciplines) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Ordem</th>
                <th>Curso</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Ordem</th>
                <th>Curso</th>
                <th>Registrado em</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($disciplines as $discipline)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd">
                @else
                  @php $i = 0; @endphp
                  <tr class="even">
                @endif
                    <td class="control sorting_1" tabindex="0" ></td>
                    <td style="display: none;">{{ $discipline->name }}</td>
                    <td style="display: none;">{{ $discipline->order }}</td>
                    <td style="display: none;">{{ $discipline->course->name  }}</td>
                    <td style="display: none;">{{isset($discipline->created_at) ? (($discipline->created_at)->format('d/m/Y H:m:s')) : ''}}</td>
                    <td style="display: none;">
                      <a href="{{ route('disciplinas.show', $discipline->id) }}" title="Editar" class="btn btn-info btn-sm" style="color: white; "><i data-feather="edit" class="font-small-4"></i></a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Disciplinas Armazenadas.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
    <!-- WEBpage-->
    <div class="col-lg-12  ">
      <div class="card ">
        <div class="card-body ">
          <!-- WEBpage-->
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
              <form class="form form-horizontal" method="POST" action="{{ route('cursos.update', $course_selected->id) }}" enctype="multipart/form-data">
                @csrf()
                  @method('PUT')

                  <div class="content-header mb-2">
                      <h2 class="fw-bolder mb-75">Página WEB do Curso</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-1">
                      <label class="form-label" for="meta_keywords">Nome da Página</label>
                      <input type="text" value="{{ $course_selected->meta_keywords }}" name="meta_keywords" id="meta_keywords" class="form-control" />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Imagem da Capa</label>
                      <img
                        class="img-fluid rounded mb-75"
                        src="{{asset('storage/images/courses/' . $course_selected->image_banner)}}"
                        alt="avatar img"
                      />
                    </div>
                    <div class="col-md-12 mb-1">
                      <label class="form-label">Alterar Imagem para Capa</label>
                      <input type="file" class="form-control" id="image_banner" name="image_banner" >
                    </div>

                    <div class="col-md-12 mb-1" hidden>
                      <textarea  name="content" id="content" class="form-control" >{!! html_entity_decode($course_selected->body, ENT_QUOTES, 'UTF-8') !!}</textarea>
                    </div>


                    <div class="col-sm-12">
                      <label class="form-label" for="category_id">Conteúdo</label>
                      <div id="full-wrapper">
                        <div id="full-container">
                          <div class="editor" id="editor-data">
                          {!! html_entity_decode($course_selected->body, ENT_QUOTES, 'UTF-8') !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                  </div>
              </form>
            </div>
          </div>
        <!-- /Register-->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
<script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
  <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'))}}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{asset(mix('js/scripts/components/components-alerts.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js'))}}"></script>
  <script src="{{ asset(mix('js/scripts/tables/disciplines.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/expense-input-mask.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/news-editor.js')) }}"></script>
@endsection
