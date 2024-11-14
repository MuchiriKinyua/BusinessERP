<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="documentations-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Resume</th>
                <th>Document Type</th>
                <th>Document Name</th>
                <th>File Path</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documentations as $documentation)
                <tr>
                    <td>{{ $documentation->employee_id }}</td>
                    <td>{{ $documentation->resume }}</td>
                    <td>{{ $documentation->document_type }}</td>
                    <td>{{ $documentation->document_name }}</td>
                    <td>{{ $documentation->file_path }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['documentations.destroy', $documentation->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('documentations.show', [$documentation->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('documentations.edit', [$documentation->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $documentations])
        </div>
    </div>
</div>
