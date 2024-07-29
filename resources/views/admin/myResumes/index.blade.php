@extends('layouts.admin')
@section('content')
@can('my_resume_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.my-resumes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.myResume.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.myResume.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MyResume">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.myResume.fields.resume') }}
                        </th>
                        <th>
                            {{ trans('cruds.myResume.fields.resume_pdf') }}
                        </th>
                        <th>
                            {{ trans('cruds.myResume.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($myResumes as $key => $myResume)
                        <tr data-entry-id="{{ $myResume->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $myResume->resume ?? '' }}
                            </td>
                            <td>
                                @if($myResume->resume_pdf)
                                    <a href="{{ $myResume->resume_pdf->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $myResume->user->name ?? '' }}
                            </td>
                            <td>
                                @can('my_resume_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.my-resumes.show', $myResume->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('my_resume_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.my-resumes.edit', $myResume->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('my_resume_delete')
                                    <form action="{{ route('admin.my-resumes.destroy', $myResume->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('my_resume_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.my-resumes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-MyResume:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection