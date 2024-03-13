<div>

    <section class="">
        <div class="items-center px-8 py-2 mx-auto max-w-7xl lg:px-80 md:px-12 lg:py-56">
          <div class="justify-center w-full text-center lg:p-10 max-auto">
            <div class="justify-center w-full mx-auto">


              <p id="typedText" class="mt-8 text-5xl  tracking-tighter text-blue-900 font-bold">

              </p>
              <p class="max-w-xl mx-auto mt-4 text-lg tracking-tight text-gray-600">
                Get ready to make unforgetable memories with us, book your <span class="font-black text-green-500 text-2xl">BET</span>  now!
              </p>
            </div>
            <div class="flex flex-col items-center justify-center max-w-xl gap-3 mx-auto mt-10 lg:flex-row">
              <a href="{{ route('book') }}" class="bg-blue-700 p-2 rounded w-32 text-white">BOOK NOW!</a>

            </div>
          </div>


        </div>
      </section>

</div>

<script>

    const textToType = "MONTE VICENTEAU RESORT";
    const typedTextElement = document.getElementById("typedText");

    function typeText() {
        for (let i = 0; i < textToType.length; i++) {
            setTimeout(() => {
                typedTextElement.textContent += textToType[i];
            }, i * 100); // Adjust the timing here (milliseconds)
        }
    }

    // Call the typing function
    typeText();
</script>
