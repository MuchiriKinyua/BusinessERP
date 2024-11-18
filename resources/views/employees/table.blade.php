<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="employees-table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Physical Address</th>
                <th>Department</th>
                <th>Hire Date</th>
                <th>Salary</th>
                <th>Disability Status</th>
                <th>Job Basis</th>
                <th>Emergency Contact</th>
                <th>Picture</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
@foreach($employees as $employee)
    <tr>
        <td>{{ $employee->first_name }}</td>
        <td>{{ $employee->last_name }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->phone_number }}</td>
        <td>{{ $employee->physical_address }}</td>
        <td>{{ $employee->department }}</td>
        <td>{{ $employee->hire_date }}</td>
        <td>{{ $employee->salary }}</td>
        <td>{{ $employee->disability_status }}</td>
        <td>{{ $employee->job_basis }}</td>
        <td>{{ $employee->emergency_contact }}</td>
        <td>
    @if($employee->stored_face_image_path)
        <img src="{{ asset($employee->stored_face_image_path) }}" width="50" height="50" alt="Face Image">
    @else
        No image
    @endif
</td>

        <td style="width: 120px">
            {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{{ route('employees.show', [$employee->id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-eye"></i>
                </a>
                <a href="{{ route('employees.edit', [$employee->id]) }}" class='btn btn-default btn-xs'>
                    <i class="far fa-edit"></i>
                </a>
                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return confirm('Are you sure?')"
                ]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $employees])
        </div>
    </div>
</div>
