<div class="dropdown">
    <button class="btn btn-xs btn-primary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bars"></i>
    </button>

    <div class="dropdown-menu cuk" aria-labelledby="dropdownMenu">
        @permission($can_edit)
            <a href="{{ $edit_url }}" data-toggle="tooltip" data-id="{{ $row_id }}" data-original-title="Edit"
                class="dropdown-item">
                <i class="fa fa-pencil"></i> Edit</a>
        @endpermission
        @permission($can_delete)
            <form action="{{ $delete_url }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')"><i
                        class="fa fa-trash"></i> Delete
                </button>
            </form>
        @endpermission
        @if (!empty($can_role_access))
            @permission($can_role_access)
                <a href="{{ $access_url }}" data-toggle="tooltip" data-id="{{ $row_id }}" data-original-title="Edit"
                    class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i> Role Access</a>
            @endpermission
        @endif
    </div>
</div>
