<?php

namespace Thesold\LaravelMediaManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Thesold\LaravelMediaManager\Contracts\MediaLibrary;
use Thesold\LaravelMediaManager\Contracts\MediaAdapter;

class MediaController extends Controller
{
    protected $adapter;
    protected $library;

    public function __construct(MediaAdapter $adapter, MediaLibrary $library)
    {
        $this->adapter = $adapter;

        $this->adapter->config([
            "cloud_name" => config('laravelmediamanager.cloud_name'),
            "api_key" => config('laravelmediamanager.api_key'),
            "api_secret" => config('laravelmediamanager.api_secret'),
          ]);

        $this->library = $library;
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
        return $this->library->upload($request->file('file'), [
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
        $resources = collect($this->library->resources($type))->collapse();

        return $resources->map(function ($key, $value) use ($mode, $width, $height, $gravity) {
            return collect($key)
            ->merge([
                'filename' => "{$key['public_id']}.{$key['format']}"
            ])
            ->merge([
                'thumbnail_url' => $this->library->url($key, [
                    "secure" => true,
                    "width" => 250,
                    "height" => 250,
                    "crop" => "thumb",
                    "gravity" => "face",
                ])
            ])->merge([
                'scaled_url' => $this->library->url($key, [
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
    public function destroy(Request $request, $id)
    {
        return $this->library->delete($id, $request->all());
    }
}
