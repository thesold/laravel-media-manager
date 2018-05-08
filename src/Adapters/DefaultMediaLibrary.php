<?php

namespace Thesold\LaravelMediaManager\Adapters;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Thesold\LaravelMediaManager\Contracts\MediaLibrary;

class DefaultMediaLibrary implements MediaLibrary
{
    protected $mediaFolder;
    protected $uploadFolder;

    public function __construct()
    {
        // Resized media is stored in this folder within the public path
        $this->mediaFolder = config('laravelmediamanager.default_folder');

        // Uploads are stored in this folder
        $this->uploadFolder = config('laravelmediamanager.upload_folder');
    }

    /**
     * Deletes a file from the media library. Only the original file will be deleted,
     * incase resized versions are in use.
     *
     * @param string|array $files
     * @param array $options
     * @return void
     */
    public function delete($files, array $options = [])
    {
        collect(array_wrap($options))->each(function ($file) {
            Storage::delete(sprintf('%s/%s', $this->uploadFolder, array_get($file, 'filename')));
        });

        return response()->json('Files deleted', 200);
    }

    /**
     * Return a list of local media resources. Currently the type parameter is not supported
     * in the default local media driver.
     *
     * @param String $type
     * @return array
     */
    public function resources(String $type = null)
    {
        return [
            'resources' => collect(Storage::files($this->uploadFolder))
                ->filter(function ($file) {
                    return !str_is("{$this->uploadFolder}.*", $file);
                })
                ->map(function ($file) {
                    $fileParts = pathinfo($file);

                    return [
                        'public_id' => array_get($fileParts, 'filename'),
                        'format' => array_get($fileParts, 'extension'),
                    ];
                })->all()
            ];
    }

    /**
     * Upload a file to the library. A random number is appended to the filename to
     * ensure it is unique within the library (well, unlikely)
     *
     * @param File $file
     * @param array $options
     * @return void
     */
    public function upload($file, array $options = [])
    {
        $filename = sprintf('%s-%s', rand(100, 999), $file->getClientOriginalName());
        return Storage::putFileAs($this->uploadFolder, $file, $filename);
    }

    /**
     * Return a public URL where the media item is accessible
     *
     * @param array $file
     * @param array $options
     * @return string
     */
    public function url($file, array $options = [])
    {
        $filename = "{$file['public_id']}.{$file['format']}";

        return asset($this->getFileFromOptions($file, $options));
    }

    /**
     * Process a media item and return the resized version of the file
     *
     * @param array $file
     * @param array $options
     * @return string
     */
    private function getFileFromOptions($file, $options = [])
    {
        extract($options);

        $originalFilename = "{$file['public_id']}.{$file['format']}";
        $resizedFilename = "{$file['public_id']}_{$width}_{$height}_{$gravity}.{$file['format']}";

        $image = Image::make(Storage::get("{$this->uploadFolder}/{$originalFilename}"));

        if (!$width || !$height) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->fit($width, $height);
        }

        $image->save(public_path("/{$this->mediaFolder}/{$resizedFilename}"));

        return "/{$this->mediaFolder}/{$resizedFilename}";
    }
}
