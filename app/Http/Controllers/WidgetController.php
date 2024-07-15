<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WidgetController extends Controller
{
    public function render(Request $request)
    {
        // $widget = $request->input('widget');
        // $data = $request->input('data');
        // $widgetClass = \App\Pagebuilder\Widgets\WidgetRegistry::getWidget($widget);
        // return view($widgetClass::$view, ['data' => $data])->render();
        $widgetClass = $request->input('widget_class');
        $widget = new $widgetClass();
        $widgetName = $widget::getName();
        $data = [
            'request' => $request,
            'settings' => $widget::getControls()
        ];

        return response()->json(['html' => $widget->render($data), 'widgetName' => $widgetName]);
        // return response()->json(['html' => view($widget::$view, ['data' => $widget->getControls()])->render()]);



        // try {
        //     $widgetName = $request->input('widget-type');
        //     $widgetClass = \App\Pagebuilder\Widgets\WidgetRegistry::getWidget($widgetName);
        //     $data = $request->input('data');
        //     return response()->json(['html' => view($widgetClass::$view, ['data' => $data])->render()]);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }

    }

    public function renderControls(Request $request)
    {
        $widgetName = $request->query("widget-type");

        $widgetClass = \App\Pagebuilder\Widgets\WidgetRegistry::getWidget($widgetName);

        if (!$widgetClass) {
            return response()->json(['error' => 'Widget not found!'], 404);
        }

        $widgetHtml = $request->input('widget', '');
        $dom = new \DOMDocument();
        @$dom->loadHTML($widgetHtml);
        $xpath = new \DOMXPath($dom);

        $returndControls = "";
        foreach ($widgetClass::getControls() as $key => $control) {
            $value = $control['default'];
            $inputElement = $xpath->query("//*[@id='$key']")->item(0);

            if ($inputElement) {
                $value = $inputElement->getAttribute('value') ?: $inputElement->nodeValue;
            }

            $returndControls .= view('widgets.controls.' . $control['type'], compact("key", "control", "value"))->render();
        }

        return response()->json(['html' => $returndControls]);
    }

    // public function renderControls(Request $request)
    // {
    //     // dd($request->all());
    //     $widgetName = $request->query("widget-type");

    //     $widgetClass = \App\Pagebuilder\Widgets\WidgetRegistry::getWidget($widgetName);

    //     if (!$widgetClass) {
    //         return response()->json(['error' => 'Widget not found!'], 404);
    //     }

    //     $returndControls = "";
    //     foreach ($widgetClass::getControls() as $key => $control) {
    //         $value = $request->query($key, $control['default']);
    //         $returndControls .= view('widgets.controls.' . $control['type'], compact("key", "control"))->render();
    //     }

    //     // foreach ($controls as $name => $control) {
    //     //     $value = $request->query($name, $control['default']);
    //     //     $renderedControls .= view('widgets.controls.' . $control['type'], compact('control', 'name', 'value'))->render();
    //     // }

    //     // return response()->json(['controls' => $renderedControls]);


    //     return response()->json(['html' => $returndControls]);



    //     // return response()->json($widgetClass::getControls());

    //     // $widget = $request->input('widget');
    //     // $data = $request->input('data');
    //     // $widgetClass = \App\Pagebuilder\Widgets\WidgetRegistry::getWidget($widget);
    //     // return $widgetClass::renderControls($data);
    //     // $widgetClass = $request->input('widget_class');
    //     // $widget = new $widgetClass();
    //     // return response()->json(['html' => $widget->renderControls()]);
    // }

    public function savePage(Request $request)
    {
        $pageContent = $request->input('page_content');
        // Here you can save $pageContent to the database
        // Example:
        // DB::table('pages')->updateOrInsert(['id' => $request->input('page_id')], ['content' => $pageContent]);
        // For simplicity, let's assume a single page storage
        Storage::put('page-builder-content.html', $pageContent);
        return response()->json(['message' => 'Page saved successfully']);
    }

    public function deletePage()
    {
        Storage::delete('page-builder-content.html');
        return response()->json(['message' => 'Page deleted successfully']);
    }

    public function loadPage()
    {
        $pageContent = Storage::exists('page-builder-content.html') ? Storage::get('page-builder-content.html') : '';
        return view('pagebuilder.editor', ['pageContent' => $pageContent]);
    }

    public function uploadImage(Request $request)
    {
        try {
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            return response()->json(['imageUrl' => '/images/' . $imageName]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while uploading the image.'], 500);
        }
    }
}
