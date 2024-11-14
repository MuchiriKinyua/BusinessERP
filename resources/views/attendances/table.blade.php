<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="attendances-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Employee Id</th>
                <th>Check In Time</th>
                <th>Check Out Time</th>
                <th>Attendance Date</th>
                <th>Over Time</th>
                <th>Under Time</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->employee_id }}</td>
                    <td>{{ $attendance->check_in_time }}</td>
                    <td>{{ $attendance->check_out_time }}</td>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->over_time }}</td>
                    <td>{{ $attendance->under_time }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['attendances.destroy', $attendance->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('attendances.show', [$attendance->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('attendances.edit', [$attendance->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $attendances])
        </div>
    </div>
</div>
