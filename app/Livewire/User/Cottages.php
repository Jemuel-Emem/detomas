<?php

namespace App\Livewire\User;
use App\Models\Cottage as Modelcottage;
use Livewire\Component;
use Livewire\WithPagination;
class Cottages extends Component
{
    use  WithPagination;
    public $search;
    public $cottagephoto, $description, $price, $cottage;
    public function render()
    {

        $search = '%' . $this->search . '%';
        return view('livewire.user.cottages', [
            'reserv' => Modelcottage::where('id', 'like', $search)->paginate(10),
        ]);

    }
    public function asss()
    {

        $this->resetPage();
    }
}
