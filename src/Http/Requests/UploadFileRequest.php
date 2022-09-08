<?php

declare(strict_types=1);

namespace BBSLab\NovaFileManager\Http\Requests;

use BBSLab\NovaFileManager\Rules\DiskExistsRule;
use BBSLab\NovaFileManager\Rules\ExistsInFilesystem;
use BBSLab\NovaFileManager\Rules\FileMissingInFilesystem;

/**
 * @property-read string|null $disk
 * @property-read string $path
 * @property-read string $file
 */
class UploadFileRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return $this->canUploadFile();
    }

    public function rules(): array
    {
        return [
            'disk' => ['sometimes', 'string', new DiskExistsRule()],
            'path' => ['required', 'string', new ExistsInFilesystem($this)],
            'file' => ['required', 'file', new FileMissingInFilesystem($this)],
        ];
    }
}
