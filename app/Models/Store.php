<?php

namespace App\Models;

use App\Models\Vendor;
use App\Scopes\ZoneScope;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $casts = [
        'minimum_order' => 'float',
        'comission' => 'float',
        'tax' => 'float',
        'minimum_shipping_charge' => 'float',
        'maximum_shipping_charge'=>'float',
        'per_km_shipping_charge' => 'float',
        'schedule_order'=>'boolean',
        'free_delivery'=>'boolean',
        'vendor_id'=>'integer',
        'status'=>'integer',
        'delivery'=>'boolean',
        'take_away'=>'boolean',
        'zone_id'=>'integer',
        'module_id'=>'integer',
        'item_section'=>'boolean',
        'reviews_section'=>'boolean',
        'active'=>'boolean',
        'gst_status'=>'boolean',
        'pos_system'=>'boolean',
        'cutlery'=>'boolean',
        'self_delivery_system'=>'integer',
        'open'=>'integer',
        'gst_code'=>'string',
        'off_day'=>'string',
        'gst'=>'string',
        'veg'=>'integer',
        'non_veg'=>'integer',
        'order_place_to_schedule_interval'=>'integer',
        'featured'=>'integer',
        'prescription_order'=>'boolean'
    ];

    protected $appends = ['gst_status','gst_code'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'gst'
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function getNameAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'name') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }

    public function getAddressAttribute($value){
        if (count($this->translations) > 0) {
            foreach ($this->translations as $translation) {
                if ($translation['key'] == 'address') {
                    return $translation['value'];
                }
            }
        }

        return $value;
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function activeCoupons()
    {
        return $this->hasMany(Coupon::class)->where('status', '=', 1)->whereDate('expire_date', '>=', date('Y-m-d'))->whereDate('start_date', '<=', date('Y-m-d'));
    }

    public function schedules()
    {
        return $this->hasMany(StoreSchedule::class)->orderBy('opening_time');
    }

    public function deliverymen()
    {
        return $this->hasMany(DeliveryMan::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }

    public function itemCampaigns()
    {
        return $this->hasMany(ItemCampaign::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Item::class);
    }

    public function getScheduleOrderAttribute($value)
    {
        return (boolean)(\App\CentralLogics\Helpers::schedule_order()?$value:0);
    }
    public function getRatingAttribute($value)
    {
        $ratings = json_decode($value, true);
        $rating5 = $ratings?$ratings[5]:0;
        $rating4 = $ratings?$ratings[4]:0;
        $rating3 = $ratings?$ratings[3]:0;
        $rating2 = $ratings?$ratings[2]:0;
        $rating1 = $ratings?$ratings[1]:0;
        return [$rating5, $rating4, $rating3, $rating2, $rating1];
    }

    public function getGstStatusAttribute()
    {
        return (boolean)($this->gst?json_decode($this->gst, true)['status']:0);
    }

    public function getGstCodeAttribute()
    {
        return (string)($this->gst?json_decode($this->gst, true)['code']:'');
    }

    public function scopeModule($query, $module_id)
    {
        return $query->where('module_id', $module_id);
    }

    public function scopeDelivery($query)
    {
        $query->where('delivery',1);
    }

    public function scopeTakeaway($query)
    {
        $query->where('take_away',1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', '=', 1);
    }

    public function scopeOpened($query)
    {
        return $query->where('active', 1);
    }


    public function scopeWithOpen($query,$longitude,$latitude)
    {
        $query->selectRaw('*, IF(((select count(*) from `store_schedule` where `stores`.`id` = `store_schedule`.`store_id` and `store_schedule`.`day` = '.now()->dayOfWeek.' and `store_schedule`.`opening_time` < "'.now()->format('H:i:s').'" and `store_schedule`.`closing_time` >"'.now()->format('H:i:s').'") > 0), true, false) as open,ST_Distance_Sphere(point(longitude, latitude),point('.$longitude.', '.$latitude.')) as distance');
    }

    public function scopeWeekday($query)
    {
        return $query->where('off_day', 'not like', "%".now()->dayOfWeek."%");
    }

    protected static function booted()
    {
        static::addGlobalScope(new ZoneScope);

        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function($query){
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }   

    public function scopeType($query, $type)
    {
        if($type == 'veg')
        {
            return $query->where('veg', true);
        }
        else if($type == 'non_veg')
        {
            return $query->where('non_veg', true);
        }

        return $query;

    }
    
    private function generateSlug($name)
    {
        $slug = Str::slug($name);
        if ($max_slug = static::where('slug', 'like',"{$slug}%")->latest('id')->value('slug')) {
            
            if($max_slug == $slug) return "{$slug}-2";

            $max_slug = explode('-',$max_slug);
            $count = array_pop($max_slug);
            if (isset($count) && is_numeric($count)) {
                $max_slug[]= ++$count;
                return implode('-', $max_slug);
            }
        }
        return $slug;
    } 


    protected static function boot()
    {
        parent::boot();
        static::created(function ($store) {
            $store->slug = $store->generateSlug($store->name);
            $store->save();
        });
    }

    
}
