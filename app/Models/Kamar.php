<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['no_kamar','tipe','harga','status'];
    protected $casts = ['harga' => 'integer'];

    const TIPE_STANDARD = 'Standard';
    const TIPE_DELUXE = 'Deluxe';
    const TIPE_SUITE = 'Suite';

    public static function tipes() {
        return [self::TIPE_STANDARD, self::TIPE_DELUXE, self::TIPE_SUITE];
    }

    const STATUS_TERSEDIA = 'Tersedia';
    const STATUS_TIDAK_TERSEDIA = 'Tidak tersedia';

    public static function statuses() {
        return [self::STATUS_TERSEDIA, self::STATUS_TIDAK_TERSEDIA];
    }

    public function reservasis() {
        return $this->hasMany(Reservasi::class);
    }
}
