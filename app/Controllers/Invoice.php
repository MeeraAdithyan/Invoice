<?php

namespace App\Controllers;

use App\Models\InvoiceItemModel;
use App\Models\InvoiceModel;

class Invoice extends BaseController
{
    public function createItem()
    {
        return view('invoice/create');
    }

    public function saveItem()
    {
        $invoiceModel = new InvoiceModel();
        $invoice = $invoiceModel->asArray()
            ->orderBy('id', 'desc')
            ->first();

        // }else{
        //     $invoice_number = 'IN'
        // }
        $invoice = [
            'sub_total_without_tax' => $this->request->getVar('sub_total_with_out_tax'),
            'discount' => $this->request->getVar('discount'),
            'sub_total_with_tax' => $this->request->getVar('sub_total_tax'),
            'total' => $this->request->getVar('grand_total'),
        ];

        if (!empty($invoice)) {
            $invoice['invoice_number'] = 'IN-1';
        } else {
            $invoice['invoice_number'] = 'IN-' . $invoice['id'];
        }
        $invoiceModel->save($invoice);
        $last_insert_id = $invoiceModel->getInsertID();

        $itemModel = new InvoiceItemModel();
        foreach ($this->request->getVar('name') as $key => $value) {
            $data[$key]['name'] = $value;
        }
        foreach ($this->request->getVar('quantity') as $key => $value) {
            $data[$key]['quantity'] = $value;
        }
        foreach ($this->request->getVar('price') as $key => $value) {
            $data[$key]['price'] = $value;
        }
        foreach ($this->request->getVar('tax') as $key => $value) {
            $data[$key]['tax'] = $value;
        }
        foreach ($this->request->getVar('total') as $key => $value) {
            $data[$key]['total'] = $value;
        }
        foreach ($data as $key => $value) {
            $value['invoice_id'] = $last_insert_id;
            $itemModel->insert($value);
            $items['item'][$key] = $value;
        }
        $items = array_merge($items, $invoice);
        return view('invoice/view',  $items);
    }
}
