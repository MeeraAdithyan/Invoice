<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'id';

    protected $allowedFields = ['invoice_number', 'sub_total_without_tax', 'discount', 'sub_total_with_tax', 'total'];
}
