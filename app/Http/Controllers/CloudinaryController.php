<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Adapters\CloudinaryMediaLibrary as MediaLibrary;
use App\Adapters\CloudinaryMediaAdapter as MediaAdapter;

class CloudinaryController extends Controller
{
    protected $adapter;

    public function __construct()
    {
        MediaAdapter::config(array(
            "cloud_name" => config('cloudinary.cloud_name'),
            "api_key" => config('cloudinary.api_key'),
            "api_secret" => config('cloudinary.api_secret'),
          ));

          $this->adapter = new MediaLibrary();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type = null)
    {
        return $this->adapter->upload($request->file('file'), [
            'public_id' => basename(
                $request->file('file')->getClientOriginalName(),
                '.'.$request->file('file')->getClientOriginalExtension()
            ),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function resources($type = null, $mode = "thumb", $width = "1280", $height = null, $gravity = "face")
    {
        $resources = collect($this->adapter->resources($type))->collapse();

        return $resources->map(function ($key, $value) use ($mode, $width, $height, $gravity) {
            return collect($key)
            ->merge([
                'filename' => "{$key['public_id']}.{$key['format']}"
            ])
            ->merge([
                'thumbnail_url' => cloudinary_url($key['public_id'], [
                    "secure" => true,
                    "width" => 250,
                    "height" => 250,
                    "crop" => "thumb",
                    "gravity" => "face",
                ])
            ])->merge([
                'scaled_url' => cloudinary_url($key['public_id'], [
                    "secure" => true,
                    "width" => $width,
                    "height" => is_null($height) ? null : $height,
                    "crop" => $mode,
                    "gravity" => $gravity,
                ])
            ]);
        })->all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->adapter->delete($id);
    }
}
