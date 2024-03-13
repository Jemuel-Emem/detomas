<?php

namespace App\Livewire\Admin;
use App\Models\ReservationList as res;
use App\Models\CancelledList as ccresult;
use App\Models\ReservationHistory as resHistory;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Livewire\Component;

class Reservationhistory extends Component
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
        return view('livewire.admin.reservationhistory', [
            'reserv' => resHistory::where('reservationid', 'like', $search)->paginate(10),
        ]);

    }
}
