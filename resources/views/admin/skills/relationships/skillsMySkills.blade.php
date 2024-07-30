@can('my_skill_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.my-skills.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mySkill.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.mySkill.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-skillsMySkills">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.job_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.job_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.to_present') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.skills') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.my_resume') }}
                        </th>
                        <th>
                            {{ trans('cruds.mySkill.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mySkills as $key => $mySkill)
                        <tr data-entry-id="{{ $mySkill->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mySkill->company ?? '' }}
                            </td>
                            <td>
                                {{ $mySkill->job_title ?? '' }}
                            </td>
                            <td>
                                {{ $mySkill->job_category->name ?? '' }}
                            </td>
                            <td>
                                {{ $mySkill->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $mySkill->end_date ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $mySkill->to_present ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $mySkill->to_present ? 'checked' : '' }}>
                            </td>
                            <td>
                                @foreach($mySkill->skills as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $mySkill->my_resume->resume ?? '' }}
                            </td>
                            <td>
                                {{ $mySkill->user->name ?? '' }}
                            </td>
                            <td>
                                @can('my_skill_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.my-skills.show', $mySkill->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('my_skill_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.my-skills.edit', $mySkill->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('my_skill_delete')
                                    <form action="{{ route('admin.my-skills.destroy', $mySkill->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('my_skill_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.my-skills.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-skillsMySkills:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection