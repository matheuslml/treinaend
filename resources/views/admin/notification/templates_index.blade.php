@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Notificações')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- users list start -->
<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Seus Modelos de Notificações - Busca Avançada</h4>
        </div>
        <hr class="my-0" />
        <div class="card-datatable">
        @if (count($notificationTemplates) >= 1)
          <table class="dt-advanced-search table">
            <thead>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Conteúdo</th>
                <th>Descrição Interna</th>
                <th>Telefone (55 + ddd + número)</th>
                <th>Tipo</th>
                <th>Sistema</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Título</th>
                <th>Conteúdo</th>
                <th>Descrição Interna</th>
                <th>Telefone (55 + ddd + número)</th>
                <th>Tipo</th>
                <th>Sistema</th>
              </tr>
            </tfoot>
            <tbody>
              @php $i = 0; @endphp
              @foreach($notificationTemplates as $template)
                @if($i == 0)
                  @php $i = 1; @endphp
                  <tr class="odd" ">
                @else
                  @php $i = 0; @endphp
                  <tr class="even" ">
                @endif
                    <td class="control sorting_1" tabindex="0" onclick="readNotification('{{ $template->id }}')" ></td>
                    <td style="display: none;">{{ $template->title }}</td>
                    <td style="display: none;">{{ $template->content }}</td>
                    <td style="display: none;">{{ $template->description }}</td>
                    <td style="display: none;">{{ $template->phone_number }}</td>
                    <td style="display: none;">{{ $template->type == 'discipline_notification' ?
                    'Pagamento' : 'Fim de Curso' }}</td>
                    <td style="display: none;">

                        <div class="btn-group">
                          <a href="{{ route('notificacao_modelos.show',  $template->id) }}" class="btn btn-info">
                                    <i data-feather="search"></i>
                          </a>
                        </div>
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Aviso</h4>
              <div class="alert-body">
                Não existem Modelos Armazenados.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/notification_templates.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection