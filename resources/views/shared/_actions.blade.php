@can('view_patients')
    <a href="{{route('patients.show', [str_singular($patient) => $patient])}}" class="btn btn-xs btn-primary">
        <i class="fa fa-eye"></i> View </a>
@endcan

@can('edit_patients')
    <a href="{{route('patients.edit', [str_singular($patient) => $patient])}}" class="btn btn-xs btn-info">
        <i class="fa fa-pencil"></i> Edit </a>
@endcan

