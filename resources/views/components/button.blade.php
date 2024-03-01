<form method="post" action="{{$action}}" class="d-inline">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="material-icons">delete</i>
    </button>
</form>
