<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="promotions-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Previous Position</th>
                <th>New Position</th>
                <th>Promotion Date</th>
                <th>Previous Salary</th>
                <th>New Salary</th>
                <th>Reason</th>
                <th>Approved By</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->employee_id }}</td>
                    <td>{{ $promotion->previous_position }}</td>
                    <td>{{ $promotion->new_position }}</td>
                    <td>{{ $promotion->promotion_date }}</td>
                    <td>{{ $promotion->previous_salary }}</td>
                    <td>{{ $promotion->new_salary }}</td>
                    <td>{{ $promotion->reason }}</td>
                    <td>{{ $promotion->approved_by }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['promotions.destroy', $promotion->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('promotions.show', [$promotion->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('promotions.edit', [$promotion->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $promotions])
        </div>
    </div>
</div>
