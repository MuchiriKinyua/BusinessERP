<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="offs-table">
            <thead>
            <tr>
                <th>Off Name</th>
                <th>Duration</th>
                <th>Paid</th>
                <th>Off Condition</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offs as $off)
                <tr>
                    <td>{{ $off->off_name }}</td>
                    <td>{{ $off->duration }}</td>
                    <td>{{ $off->paid }}</td>
                    <td>{{ $off->off_condition }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['offs.destroy', $off->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('offs.show', [$off->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('offs.edit', [$off->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $offs])
        </div>
    </div>
</div>
