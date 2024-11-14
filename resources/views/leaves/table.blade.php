<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="leaves-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Leave Type Id</th>
                <th>Department Id</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Duration</th>
                <th>Leave Status</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee_id }}</td>
                    <td>{{ $leave->leave_type_id }}</td>
                    <td>{{ $leave->department_id }}</td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td>{{ $leave->duration }}</td>
                    <td>{{ $leave->leave_status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['leaves.destroy', $leave->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('leaves.show', [$leave->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('leaves.edit', [$leave->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $leaves])
        </div>
    </div>
</div>
