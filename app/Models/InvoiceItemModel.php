<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceItemModel extends Model
{
    protected $table = 'invoice_item';
    protected $primaryKey = 'id';

    protected $allowedFields = ['invoice_id','name', 'quantity', 'unit_price', 'tax', 'total'];
}
