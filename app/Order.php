<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{	
    use SoftDeletes;
    
    /**
     * Fillable attribute.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bus_id',
        'amount',
        'nama',
        'no_ktp',
        'email',
        'phone',
        'keberangkatan',
        'tujuan',
        'tgl_sewa',
        'tgl_sampai',
        'alamat_jemputan',
        'waktu_jemput',
        'catatan',
        'detail_tujuan',
    ];
 
    /**
     * Set status to Pending
     *
     * @return void
     */
    public function setPending()
    {
        $this->attributes['status'] = 'pending';
        self::save();
    }
 
    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
        $this->attributes['status'] = 'success';
        self::save();
    }
 
    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
        $this->attributes['status'] = 'failed';
        self::save();
    }
 
    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
        $this->attributes['status'] = 'expired';
        self::save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function buses()
    {
        return $this->belongsTo(Bus::class, 'bus_id')->withTrashed();
    }

    public function poBus()
    {
        return $this->belongsTo(PoBus::class, 'po_id')->withTrashed();
    }
}
