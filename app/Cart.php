<?php
namespace App;

class Cart{

    public $items;
    public $totalQuantity;
    public $totalPrice;

    public function __construct($prevCart){

        if ($prevCart != null){
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
        }

        else{
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }

    public function addItem($id, $product){
        // $price = (int) str_replace("$", "", $product->price);
        $price = $product->price;

        //if product already exists:
        if (array_key_exists($id, $this->items)){
            $productToAdd = $this->items[$id];
            $productToAdd['quantity']++;
            $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] * $price;
        }
        //first time products:
        else{
            $productToAdd = ['quantity' => 1, 'totalSinglePrice' => $price, 'data' => $product];
        }

        $this->items[$id] = $productToAdd;
        $this->totalQuantity++;
        $this->totalPrice = $this->totalPrice + $price;
    }

    public function updatePriceAndQuantity(){
        $totalQuantity = 0;
        $totalPrice = 0;
        foreach ($this->items as $item){
            $totalQuantity = $totalQuantity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
        }
        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
    }
}