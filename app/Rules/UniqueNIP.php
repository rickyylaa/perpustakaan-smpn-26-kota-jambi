<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueNip implements ValidationRule
{
    protected ?int $ignoreId;
    protected ?string $entity;

    public function __construct(?int $ignoreId = null, ?string $entity = null)
    {
        $this->ignoreId = $ignoreId;
        $this->entity = $entity;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existsInAdmin = DB::table('admins')
            ->where('nip', $value)
            ->when($this->entity === 'admin' && !is_null($this->ignoreId), fn($query) => $query->where('id', '!=', $this->ignoreId))
            ->exists();

        $existsInPetugas = DB::table('petugas')
            ->where('nip', $value)
            ->when($this->entity === 'petugas' && !is_null($this->ignoreId), fn($query) => $query->where('id', '!=', $this->ignoreId))
            ->exists();

        if ($existsInAdmin || $existsInPetugas) {
            $fail('NIP sudah digunakan.');
        }
    }
}
