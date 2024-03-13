<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList as res;
use App\Models\CancelledList as ccresult;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
class Cancelledlist extends Component
{
    use Actions;
    use  WithPagination;

    public $fullname;
    public $location;
    public $number;
    public $cottagenumber;
    public $children;
    public $adults;
    public $checkin;
    public $checkout;
    public $totalbill;
    public $photopayment;
    public $paymenttype;
    public $photoid,$reservationid;
    public $search, $Id;
    public $guest_id;
    public $edit_modal = false;
    public function render()
    {

        $search = '%' . $this->search . '%';
        return view('livewire.admin.cancelledlist', [
            'reserv' => ccresult::where('reservationid', 'like', $search)->paginate(10),
        ]);

    }

    public function confirmDelete($id){
        $record = ccresult::find($id);
        $record->delete();

        $this->resetPage();
        $this->edit_modal = false;;

    }
    public function delete(){
        $this->edit_modal = true;
    }
    public function asss()
    {

        $this->resetPage();
    }

    // public function edit($valueId){
    //     $data = ccresult::where('id', $valueId)->first();

    //     if ($data) {

    //         $this->reservationid = $data->reservationid;
    //         $this->fullname = $data->fullname;
    //         $this->location = $data->location;
    //         $this->number = $data->number;
    //         $this->cottagenumber = $data->cottagenumber;
    //         $this->paymenttype = $data->paymenttype;
    //         $this->children = $data->children;
    //         $this->adults = $data->adults;
    //         $this->checkin = $data->checkin;
    //         $this->checkout = $data->checkout;
    //         $this->totalbill = $data->totalbill;
    //         $this->photopayment = $data->photopayment;
    //         $this->photoid = $data->photoid;
    //         $this->guest_id = $data->id;

    //     }
    // }


    // public function submitEdit()
    // {
    //     $data = ccresult::where('id', $this->guest_id)->first();

    //     $data->update([
    //        'reservationid' => $this->reservationid,
    //         'fullname' => $this->fullname,
    //         'location' => $this->location,
    //         'number' => $this->number,
    //         'cottagenumber' => $this->cottagenumber,
    //         'paymenttype' => $this->paymenttype,
    //         'children' => $this->children,
    //         'adults' => $this->adults,
    //         'checkin' => $this->checkin,
    //         'checkout' => $this->checkout,
    //         'totalbill' => $this->totalbill,
    //         'photopayment' => $this->photopayment,
    //         'photoid' => $this->photoid,
    //     ]);
    //     $this->notification()->success(
    //         $title = 'Data Update',
    //         $description = 'The data has been updated successfully'
    //     );
    //     $this->edit_modal = false;
    //     $this->reset([

    //     ]);
    // }


    public function back(){

    }
}
