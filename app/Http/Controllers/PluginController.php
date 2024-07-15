<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PluginController extends Controller
{
    public function index()
    {
        $plugins = Plugin::all();
        return view('plugins.index', compact('plugins'));
    }

    // public function install(Request $request)
    // {
    //     $request->validate([
    //         'plugin' => 'required|file|mimes:zip',
    //     ]);

    //     // Upload the plugin zip file
    //     $path = $request->file('plugin')->store('plugins', 'public');

    //     // Extract the zip file
    //     $zip = new \ZipArchive;
    //     if ($zip->open(Storage::disk('public')->path($path)) === TRUE) {
    //         $zip->extractTo(base_path('plugins'));
    //         $zip->close();
    //     }

    //     // Get plugin info from extracted files
    //     $pluginInfo = json_decode(file_get_contents(base_path('plugins/plugin.json')), true);

    //     // Save plugin info to the database
    //     $plugin = Plugin::create([
    //         'name' => $pluginInfo['name'],
    //         'slug' => $pluginInfo['slug'],
    //         'description' => $pluginInfo['description'],
    //         'version' => $pluginInfo['version'],
    //     ]);

    //     // Handle dependencies
    //     if (isset($pluginInfo['dependencies'])) {
    //         foreach ($pluginInfo['dependencies'] as $dependencySlug) {
    //             $dependency = Plugin::where('slug', $dependencySlug)->first();
    //             if ($dependency) {
    //                 $plugin->dependencies()->attach($dependency->id);
    //             }
    //         }
    //     }

    //     return redirect()->route('plugins.index')->with('success', 'Plugin installed successfully.');
    // }

    public function install(Request $request)
    {
        $request->validate([
            'plugin' => 'required|file|mimes:zip',
        ]);


        // Upload the plugin zip file
        $path = $request->file('plugin')->store('plugins', 'public');

        // Create a unique temporary directory for extraction
        $tempDir = storage_path('app/public/plugins/' . uniqid('plugin_', true));

        // Extract the zip file
        $zip = new \ZipArchive;
        if ($zip->open(Storage::disk('public')->path($path)) === TRUE) {
            $zip->extractTo($tempDir);
            $zip->close();
        } else {
            return redirect()->route('plugins.index')->with('error', 'Failed to open the zip file.');
        }

        // Verify the extracted plugin info file
        $pluginJsonPath = $tempDir . '/plugin.json';
        if (!File::exists($pluginJsonPath)) {
            // Clean up the temporary directory
            File::deleteDirectory($tempDir);
            return redirect()->route('plugins.index')->with('error', 'plugin.json not found in the zip file.');
        }

        // Get plugin info from the extracted files
        $pluginInfo = json_decode(file_get_contents($pluginJsonPath), true);

        // Move the extracted files to the final plugin directory
        $pluginDir = base_path('plugins/' . $pluginInfo['slug']);
        File::moveDirectory($tempDir, $pluginDir);

        // Clean up the temporary directory
        File::deleteDirectory($tempDir);

        // Save plugin info to the database
        $plugin = Plugin::create([
            'name' => $pluginInfo['name'],
            'slug' => $pluginInfo['slug'],
            'description' => $pluginInfo['description'],
            'version' => $pluginInfo['version'],
        ]);

        // Handle dependencies
        if (isset($pluginInfo['dependencies'])) {
            foreach ($pluginInfo['dependencies'] as $dependencySlug) {
                $dependency = Plugin::where('slug', $dependencySlug)->first();
                if ($dependency) {
                    $plugin->dependencies()->attach($dependency->id);
                }
            }
        }

        // Register the service provider dynamically
        $serviceProvider = 'Plugins\\' . ucwords(str_replace(['[', ']', '-'], ['', '', ''], $plugin->slug)) . '\\' . "Plugin" . 'ServiceProvider';
        app()->register($serviceProvider);

        return redirect()->route('plugins.index')->with('success', 'Plugin installed successfully.');
    }

    public function uninstall($id)
    {
        $plugin = Plugin::findOrFail($id);

        // Remove plugin files
        Storage::disk('public')->deleteDirectory('plugins/' . $plugin->slug);

        // Remove plugin from the database
        $plugin->delete();

        return redirect()->route('plugins.index')->with('success', 'Plugin uninstalled successfully.');
    }
}