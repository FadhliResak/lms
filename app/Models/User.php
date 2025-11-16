<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public const ROLE_KEPALA_SEKOLAH = 'kepala_sekolah';

    public const ROLE_WAKIL_KURIKULUM = 'wakil_kurikulum';

    public const ROLE_WAKIL_KESISWAAN = 'wakil_kesiswaan';

    public const ROLE_WAKIL_SARPRAS = 'wakil_sarpras';

    public const ROLE_WAKIL_HUMAS = 'wakil_humas';

    public const ROLE_GURU_PEMBIMBING_PKL = 'guru_pembimbing_pkl';

    public const ROLE_TENAGA_ADMINISTRASI = 'tenaga_administrasi';

    public const ROLE_SISWA = 'siswa';

    public const ROLE_ORANG_TUA = 'orang_tua';

    public const ROLE_MITRA_INDUSTRI = 'mitra_industri';

    public const ROLE_ALUMNI = 'alumni';

    public function isRole(string $role): bool
    {
        return $this->role === $role;
    }
}
