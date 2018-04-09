<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = ['data'];

    public function getItemName()
    {
        $data = json_decode($this->data);
        return $data->item_name;
    }
    
    public function getSid()
    {
        if ($this->isSubscription()) {
            return json_decode($this->data)->sid;
        }
        return "Not a subscription";
    }

    public function isSubscription()
    {
        return property_exists(json_decode($this->data), "sid");
    }
}
