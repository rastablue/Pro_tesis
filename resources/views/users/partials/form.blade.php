<hr>
<h3>Lista de roles</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach ($roles as $role)
            <li>
                <label>

                    {!! Form::model($user, ['route' => ['users.update', $user->id]]) !!}

                        {{ Form::checkbox('roles[]', $role->id, null) }}
                        {{ $role->name }}
                        <em>({{ $role->description ?: 'N/A' }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>
