<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'id_outlet'=>$this->id_outlet,
            'outlet'=>$this->outlet,
            'jenis'=>$this->jenis,
            'nama_paket'=>$this->nama_paket,
            'harga'=>$this->harga,
        ];
    }
}
