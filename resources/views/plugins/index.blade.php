@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Plugins</h1>
        <form action="{{ route('plugins.install') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="plugin" required>
            <button type="submit" class="btn btn-primary">Install Plugin</button>
        </form>
        <hr>
        <ul>
            @foreach ($plugins as $plugin)
                <li>
                    {{ $plugin->name }} ({{ $plugin->version }})
                    <form action="{{ route('plugins.uninstall', $plugin->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Uninstall</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
