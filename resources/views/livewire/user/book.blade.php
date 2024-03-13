<div>

    <section>
        <div class=" flex justify-center max-h-full overflow-hidden lg:px-0 md:px-12 ">
            <div class=" z-10 flex flex-col flex-1  bg-white shadow-2xl  md:flex-none md:px-6 sm:justify-center">
                    <div class="flex flex-col md:p-0 p-10">
                        <div>

                            <h2 class="text-2xl md:text-4xl text-blue-700 text-center">Reserve Now!</h2>
                            <p class="mt-2 text-sm md:text-base text-gray-500 ">
                                Complete the details below so I can process your request and then
                                schedule a time to discuss your goals.
                            </p>
                            <p>Details for payment <span class="text-blue-700">GCASH-0900080</span> or <span class="text-blue-700">BANK-0808080</span></p>
                        </div>


                    </div>
                    <div class="grid grid-cols-2 ">
                      <div> @error('fullname') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('bookdate') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('location') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('number') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('cottagenumber') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('paymenttype') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('children') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                      <div> @error('adults') <span class="text-red-500">*{{ $message }}</span> @enderror</div>
                    </div>


                    <form wire:submit.prevent="booknow">
                        <div class="mt-4 space-y-2 p-4 ">
                            <div class="flex md:justify-end justify-center">
                                <div class="  md:w-60 ">
                                    <x-datetime-picker
                                    label="Appointment Date"
                                    placeholder="Appointment Date"
                                    wire:model.defer="bookdate"
                                    without-time
                                />
                                </div>
                            </div>

                            <div class="md:mx-0 mx-12">
                                <x-input wire:model="fullname" label="Fullname" placeholder="Fullname" wire:ignore />
                            </div>

                            <div class="md:mx-0 mx-12 col-span-full">
                                <x-input wire:model="location"  label="Location" placeholder="Location" wire:ignore/>
                            </div>
                            <div class="col-span-full md:mx-0 mx-12">
                                <x-input wire:model="number"  label="Number" placeholder="number" />
                            </div>

                            <div class="col-span-full md:mx-0 mx-12">
                                <x-native-select
                                   label="Select Cottage"
                                   placeholder="Select cottage"
                                   :options="$cottageNumbers"
                                 wire:model="cottagenumber"
                                   />
                            </div>

                            <div class="col-span-full md:mx-0 mx-12">
                                <x-native-select
                                wire:input="recalculateTotal"
                                   label="Select Payment"
                                   placeholder="Select payment"
                                   :options="['Fully Paid', 'Partial']"
                                 wire:model="paymenttype"
                                   />
                            </div>

                            <div class="flex justify-between gap-2 md:mx-0 mx-12">
                                <div>

                                    <x-input wire:model="children" wire:input="recalculateTotal" label="# of Childrens" placeholder="Number of childrens"  />

                                </div>
                                <div>
                                    <x-input wire:model="adults" wire:input="recalculateTotal" label="# of Adults" placeholder="Number of adults"  />
                                </div>
                            </div>

                            <div class="flex justify-center gap-2 md:flex-row flex-col">
                                <div class="md:mx-0 mx-12">
                                    <x-time-picker
                                    label="Check In"
                                    placeholder="Appoitment date"
                                    wire:model.defer="checkin"
                                />
                                </div>

                                <div class="md:mx-0 mx-12">
                                    <x-time-picker
                                    label="Check Out"
                                    placeholder="Appoitment date"
                                    wire:model.defer="checkout"
                                />
                                </div>
                            </div>
                            <div class="col-span-full md:mx-0 mx-12">
                                <x-input wire:model="calculatedTotal"  label="Total Bill" disabled placeholder="" />
                            </div>
                            <div class="">

                                <label class="block mb-3 text-sm md:text-base font-medium text-gray-600"
                                name="email">
                                Proof of Payment
                            </label>
                            <input type="file" wire:model="photopayment" accept="image/*" >
                            </div>
                            <div class="col-span-full">
                                <label class="block mb-3 text-sm md:text-base font-medium text-gray-600"
                                    name="email">
                                    Valid ID
                                </label>
                                <input type="file" wire:model="photoid" >

                            </div>
                            <div class="col-span-full">
                                <button
                                    class="items-center justify-center w-full px-6 py-2.5 text-center text-white duration-200 bg-green-700 border-2 rounded-full inline-flex hover:bg-transparent hover:bg-green-900 focus:outline-none "
                                    type="submit">
                                    BOOK
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

</div>
