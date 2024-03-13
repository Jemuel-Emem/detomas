<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Cottage;
use App\Models\ReservationList as reservationlist;
use App\Models\Reservation;
use WireUi\Traits\Actions;
use App\Models\Totalincome as totalincome;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Book extends Component
{
    use Actions;
    use WithFileUploads;
    public $cottageNumbers = [];
    public $fullname;
    public $bookdate;
    public $location;
    public $number;
    public $cottagenumber;
    public $children;
    public $adults;
    public $checkin;
    public $checkout;
    public $totalbill;
    public $photopayment;
    public $photoid;
    public $paymenttype;
    public $price;
    public $calculatedTotal;
    public $selectedCottagePrice;


    public function mount()
    {
        // $this->cottageNumbers = Cottage::pluck('cottagecode')->toArray();
        //  $this->loadCottagePrice($this->cottageNumbers[0]);

        $this->cottageNumbers = Cottage::where('status', 'available')->pluck('cottagecode')->toArray();
        // $this->cottagenumber = null;
        // $this->loadCottagePrice($this->cottageNumbers[0]);

    }

    private function loadCottagePrice($cottageId)
{

    $cottage = Cottage::where('cottagecode', $cottageId)->first();

    if ($cottage) {
        $this->selectedCottagePrice = $cottage->price;

    } else {
        dd("Cottage not found!");
    }
}

    public function render()
    {
        return view('livewire.user.book');
    }
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:255|regex:/^[^0-9]+$/',
            'bookdate' => 'required',
            'location' => 'required|string',
            'cottagenumber' => 'required|number|max:255',
            'number' => 'required|numeric|digits:11',
            'cottagenumber' => 'required',
            'paymenttype'=>'required',
            'children' => 'required|integer|min:1',
            'adults' => 'required|integer|min:1',

        ];
    }


    public function booknow(){

        if ($this->paymenttype=="Fully Paid"){

            $this->validate();

            $selectedCottage = Cottage::where('cottagecode', $this->cottagenumber)->first();

            if ($selectedCottage && $selectedCottage->status === 'not available') {
                $this->notification()->error(
                    $title = 'Cottage Not Available',
                    $description = 'The selected cottage is not available for reservation.'
                );
                return;
            }
            $photopaymentpath = $this->photopayment->store('photos', 'public');

            $photoidpath = $this->photoid ? $this->photoid->store('photos', 'public') : null;
            $formattedBookDate = Carbon::parse($this->bookdate)->toDateString();
            $nextId = Str::random(6);
            $reservation = new reservationlist([
                'reservationid' => 'srv' . $nextId,
                'bookdate' => $formattedBookDate,
                'fullname' => $this->fullname,
                'location' => $this->location,
                'number' => $this->number,
                'cottagenumber' => $this->cottagenumber,
                'paymenttype' => $this->paymenttype,
                'children' => $this->children,
                'adults' => $this->adults,
                'checkin' => Carbon::parse($this->checkin)->toTimeString(),
                'checkout' => Carbon::parse($this->checkout)->toTimeString(),
                'totalbill' => $this->calculatedTotal,
                'photopayment' => $photopaymentpath,
                'photoid' => $photoidpath,

            ]);
            totalincome::create([
                'income' =>$this->calculatedTotal,
            ]);
            $this->updateCottageStatus($this->cottagenumber);
          //  $this->cottagenumber->delete();
            $reservation->save();
            $this->dialog()->show([
                'title'       => 'Reservation Saved',
                'description' => 'Your reservation was successfully saved. Your reservation ID is srv' . $nextId,
                'icon'        => 'success'
            ]);
          $this->render();
            $this->resetForm();
            }

        else {


            $this->validate();
            $selectedCottage = Cottage::where('cottagecode', $this->cottagenumber)->first();

            if ($selectedCottage && $selectedCottage->status === 'not available') {
                $this->notification()->error(
                    $title = 'Cottage Not Available',
                    $description = 'The selected cottage is not available for reservation.'
                );
                return;
            }
            $photopaymentpath = $this->photopayment->store('photos', 'public');

            $photoidpath = $this->photoid ? $this->photoid->store('photos', 'public') : null;
            $formattedBookDate = Carbon::parse($this->bookdate)->toDateString();
            $nextId = Str::random(6);
           $reservation = new Reservation([

            'reservationid' => 'srv' . $nextId,
            'bookdate' => $formattedBookDate,
            'fullname' => $this->fullname,
            'location' => $this->location,
            'number' => $this->number,
            'cottagenumber' => $this->cottagenumber,
            'paymenttype' => $this->paymenttype,
            'children' => $this->children,
            'adults' => $this->adults,
            'checkin' => Carbon::parse($this->checkin)->toTimeString(),
            'checkout' => Carbon::parse($this->checkout)->toTimeString(),
            'totalbill' => $this->calculatedTotal,
            'photopayment' => $photopaymentpath,
            'photoid' => $photoidpath,
        ]);
            $reservation->save();
            $this->dialog()->show([
                'title'       => 'Book Saved',
                'description' => 'Your reservation was successfully saved. Your reservation ID is srv' . $nextId,
                'icon'        => 'success'
            ]);
          $this->render();
            $this->resetForm();
            }


        }



    private function updateCottageStatus($cottageCode)
    {
       // dd('Provided Cottage Code:', $cottageCode);

    $cottage = Cottage::where('cottagecode', $cottageCode)->first();

    // Add debug statement to check if the cottage is found
    // dd('Cottage found:', $cottage);

    if ($cottage) {
        $cottage->update([
            'status' => 'not available',
        ]);

    } else {
        dd('Cottage not found.');
    }
}

    private function resetForm()
    {
        $this->fullname = '';
        $this->location = '';
        $this->number = '';
        $this->children = '';
        $this->adults = '';
        $this->checkin = '';
        $this->checkout = '';
        $this->totalbill = '';
        $this->photopayment = null;
        $this->photoid = null;
    }

    public function updatedChildren()
    {
        $this->recalculateTotal();
    }

    public function updatedAdults()
    {
        $this->recalculateTotal();
    }

    public function recalculateTotal()
    {
        $children = is_numeric($this->children) ? $this->children : 0;
        $adults = is_numeric($this->adults) ? $this->adults : 0;
        $this->calculatedTotal = ($children * 30) + ($adults * 50) + $this->selectedCottagePrice;
    }

    public function updatedCottagenumber()
    {
        $this->loadCottagePrice($this->cottagenumber);
        $this->recalculateTotal();
    }
}
