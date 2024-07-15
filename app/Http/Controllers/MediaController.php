<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm,ogg,mp3,wav,flac,3gp,avi,mkv,mov,wmv,doc,docx,pdf,txt,zip,rar|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/media', $fileName);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'file' => $fileName,
        ]);
    }
}
