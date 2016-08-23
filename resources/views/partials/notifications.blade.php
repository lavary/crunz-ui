@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">{{session('warning')}}</div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif