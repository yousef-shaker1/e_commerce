<?php

namespace App\Livewire;

use App\Models\order;
use App\Models\section;
use Livewire\Component;
use Livewire\WithPagination;

class OrderAdmin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $customer_name;
    public $product_name;
    public $search;
    public function render()
    {
        $orders = order::with('product', 'customer')
        ->when($this->search, function ($query) {
            $query->whereHas('customer', function ($q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orWhereHas('product', function ($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        })
        ->paginate(10);
        return view('livewire.order-admin', compact('orders'));
    }
    public function updatedSearch()
    {
        $this->dispatch('searchUpdated');
    }

    public function deleteOrder($id)
    {
        $order = order::find($id);
        if($order){
            $this->id = $order->id;
            $this->customer_name = $order->customer->name;
            $this->product_name = $order->product->name;
        } else {
            session()->flash('delete', 'Order not found');
            return redirect()->back();
        }
    }

    public function destroyOrder(){
        order::where('id', $this->id)->delete();
        session()->flash('delete', 'Order deleted successfully');
        $this->dispatch('close-modal');
    }
    public function status1($id)
    {
        order::where('id',$id)->update([
            'status' => 'قبول',
        ]);
    }
    public function status2($id)
    {
        order::where('id',$id)->update([
            'status' => 'رفض',
        ]);
    }
    public function status3($id)
    {
        order::where('id',$id)->update([
            'status' => 'اتمام',
        ]);
    }

    public function closeModal(){
        $this->resetInput();
    }

    public function resetInput(){
        $this->id = '';
        $this->customer_name = '';
        $this->product_name = '';
    }
}
