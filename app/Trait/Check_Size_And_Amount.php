<?php 

namespace App\Trait;

trait Check_Size_And_Amount{
  public function checkSizeAndAmount($selectedColor,$selectedSize, $amount){
    if (!$selectedColor || !$selectedSize) {
      session()->flash('error', 'من فضلك اختر اللون والمقاس');
      return false;
  }
  if($amount == 0 && $selectedSize == true){
      session()->flash('error', 'لا يوجد كمية كافية');
      return false;
  }
  return true;
  }

  public function checkSizeAndAmountNoColor($selectedSize, $amount){
    if (!$this->selectedSize) {
      session()->flash('error', 'من فضلك اختر المقاس');
      return false;
    }
    if($this->amount == 0 && $this->selectedSize == true){
        session()->flash('error', 'لا يوجد كمية كافية');
        return false;
    }
    return true;
  }
}