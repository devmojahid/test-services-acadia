{{-- php --}}
<!-- resources/views/page-builder.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Page Builder</title>
    <link rel="stylesheet" href="{{ asset('assets/css/pagebuilder.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toster.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/toster.js') }}" defer></script>
    <script type="module" src="{{ asset('assets/js/pagebuilder.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="page-builder">
        <div id="toaster-container"></div>
        <div id="widgets-sidebar">
            @foreach (App\Pagebuilder\Widgets\WidgetRegistry::getWidgets() as $widget)
                <div class="widget-item" draggable="true" data-widget="{{ get_class($widget) }}">
                    <h3>{{ $widget->getTitle() }}</h3>
                    <i class="{{ $widget::getIcon() }}"></i>
                </div>
            @endforeach
        </div>
        <div id="main-canvas">
            {!! $pageContent ?? '' !!}
        </div>
        <div id="canvas-pagecontent-edit-controlls-list" class="d-flex">
            <h2>Please select a section first</h2>
        </div>
    </div>
    <div id="edit-widget-form">
        <button id="save-page">Save</button>
        <button id="delete-page">Delete</button>
        <button id="undo">Undo</button>
        <button id="redo">Redo</button>
    </div>
</body>

</html>
