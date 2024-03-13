
  {{-- <div class="flex justify-center h-screen">
   <div class="ml-70 w-full  flex justify-center md:mt-20 mt-20">
    <img src="{{ asset('images/mapfinal.png') }}" alt="" class="md:w-8/12 w-full md:h-full h-60 shadow-sm rounded-xl" >
   </div>
  </div> --}}
<div>
    <div class="h-screen">
        <div class="flex gap-2 mt-2">
            <x-input label="" placeholder="Search..." wire:model="search" />
        <div>
            <x-button  label="Search " wire:click.prevent="asss" class="bg-green-700 text-white hover:bg-green-900" />
        </div>
        </div>
        {{-- <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                           Cottage Number
                         </th>
                         <th scope="col" class="px-6 py-3">
                            Cottage Code
                          </th>
                        <th scope="col" class="px-6 py-3">
                          Cottage Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Cottage Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cottage Photo
                         </th>

                         <th scope="col" class="px-6 py-3">
                            Status
                         </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($reserv as $cot)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $cot->id }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $cot->cottagecode }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $cot->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $cot->price }}
                        </td>

                        <td class="px-6 py-4">
                            <img src="{{ asset(Storage::url($cot->cottagephoto)) }}" alt="Valid ID" class="w-20 h-16 rounded">
                        </td>

                        <td class="px-6 py-4">
                            {{ $cot->status }}
                        </td>
                    </tr>


                @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">
                            <div class="mt-4">
                                {{ $reserv->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div> --}}
<div class="grid md:grid-cols-4 grid-cols-1 mt-4 gap-2">
    @foreach($reserv as $cot)
    <x-card >
<div class="flex flex-col relative">
    <label for="">Cottage Number: {{ $cot->id }}</label>
    <label for="">Cottage Code: {{ $cot->cottagecode }}</label>
    <label for="">Cottage Description :   {{ $cot->description }}</label>
    <label for="">Price:  {{ $cot->price }}</label>
    @if ($cot->status=='available')
    <label for="" class="text-green-500">Status:  {{ $cot->status }}</label>
 @elseif($cot->status=='not available')
 <label for="" class="text-red-500">Status:  {{ $cot->status }}</label>
    @endif

    <div class="absolute md:top-4 top-2 md:right-4 right-2">
        <img src="{{ asset(Storage::url($cot->cottagephoto)) }}" alt="Valid ID" class="md:w-20 w-12 md:h-16 h-10 rounded">

    </div>
</div>
    </x-card>
    @endforeach
</div>

    </div>
</div>

