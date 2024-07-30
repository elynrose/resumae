@extends('layouts.admin')
@section('content')
@can('job_skill_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.job-skills.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.jobSkill.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.jobSkill.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-JobSkill">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.jobSkill.fields.job_posting') }}
                        </th>
                        <th>
                            {{ trans('cruds.jobSkill.fields.skills') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobSkills as $key => $jobSkill)
                        <tr data-entry-id="{{ $jobSkill->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $jobSkill->job_posting->job_title ?? '' }}
                            </td>
                            <td>
                                {{ $jobSkill->skills ?? '' }}
                            </td>
                            <td>
                                @can('job_skill_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.job-skills.show', $jobSkill->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('job_skill_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.job-skills.edit', $jobSkill->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('job_skill_delete')
                                    <form action="{{ route('admin.job-skills.destroy', $jobSkill->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('job_skill_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.job-skills.massDestroy') }}",
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
  let table = $('.datatable-JobSkill:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection