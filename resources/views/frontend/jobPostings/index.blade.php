@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('job_posting_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.job-postings.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.jobPosting.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.jobPosting.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-JobPosting">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.jobPosting.fields.job_title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobPosting.fields.job_category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobPosting.fields.job_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobPosting.fields.expiry_date') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobPostings as $key => $jobPosting)
                                    <tr data-entry-id="{{ $jobPosting->id }}">
                                        <td>
                                            {{ $jobPosting->job_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobPosting->job_category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\JobPosting::JOB_TYPE_SELECT[$jobPosting->job_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobPosting->expiry_date ?? '' }}
                                        </td>
                                        <td>
                                            @can('job_posting_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.job-postings.show', $jobPosting->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('job_posting_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.job-postings.edit', $jobPosting->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('job_posting_delete')
                                                <form action="{{ route('frontend.job-postings.destroy', $jobPosting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('job_posting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.job-postings.massDestroy') }}",
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
  let table = $('.datatable-JobPosting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection