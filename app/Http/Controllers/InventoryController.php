<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function getListInventory()
    {
        $inventories = inventory::getListInventory();
        return view('admin.inventory.index')->with(compact('inventories'));
    }
}
