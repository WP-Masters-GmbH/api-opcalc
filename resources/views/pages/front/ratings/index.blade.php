<x-front.layout title="{{ $title }}" script="ratings">
    <main class="mt-[68px]">
        <section class="section pt-24">
            <div class="grid grid-cols-2 gap-5  md:grid-cols-5">
                <div class="col-span-2 flex md:justify-center items-center">
                    <div>
                        <h1 class="text-black"><span class="text-5xl">{{ $symbol }}</span>  <span class="text-3xl text-black"> - Apple, inc</span></h1>
                        <p class="text-black text-4xl">$180.76</p>
                        <div class="flex gap-2 items-end">
                            <p class="text-green-500 text-2xl leading-none"><span class="inline-block triangle-up border-green-500"></span>&nbsp;1.2%</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-3">
                    <ul class="[&>li:nth-child(odd)]:bg-gray-200 [&>li:last-child]:border-gray-300 [&>li:last-child]:border-b-2 [&>li:first-child]:border-gray-300 [&>li:first-child]:border-t-2">
                        <li class="flex justify-between items-center py-3 px-2">
                           <p class="text-black">
                                Market Cap
                            </p>
                            <p class="text-black">
                                $2.75T
                            </p>
                        </li>
                        <li class="flex justify-between items-center py-3 px-2">
                            <p class="text-black">
                                 52week range
                             </p>
                             <p class="text-black">
                                 $110.30 - $205.30
                             </p>
                         </li>
                         <li class="flex justify-between border-t-2 border-gray-300 items-center py-3 px-2">
                            <p class="text-black">
                                 Beta
                             </p>
                             <p class="text-black">
                                 1.05
                             </p>
                         </li>
                         <li class="flex justify-between items-center py-3 px-2">
                            <p class="text-black">
                                 Return against SPY
                             </p>
                             <p class="text-black">
                                 12.35%
                             </p>
                         </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section pt-10 pb-5">
            <h2 class="font-bold text-blue-primary text-[19px]">
                {{ $symbol }} Stock Analysts Estimates, Ratings and Price Targets
            </h2>
            <div class="pt-5 grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="bg-white border border-gray-300 rounded-md">
                    <p class="px-6 py-4 text-black text-lg border-b border-gray-300">
                        Analysts Consensus: HODL
                    </p>
                    <div class="flex justify-center items-center">
                        <div class="w-[430px] h-[450px] p-4 overflow-hidden relative">
                            <div class="absolute left-0 right-0 bottom-0 top-0 p-3 md:p-0">
                                <canvas id="analysts" width="460" height="250"></canvas>
                            </div>
                            <div class="flex justify-center items-center h-full w-full">
                                <div class="rotate-[25deg] origin-center-left-mob md:origin-center-left">
                                    <svg class="w-[150px] h-[150px] md:h-[250px] md:w-[230px]"  width="230px" height="250px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 4V20M12 4L8 8M12 4L16 8" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 flex flex-wrap gap-5 p-3 md:p-0">
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#C11F1F]"></span>
                                    <p> &nbsp;- Sell</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#c65326]"></span>
                                    <p> &nbsp;- Moderate Sell</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#d1cb34]"></span>
                                    <p> &nbsp;- Hold</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#7ce9cb]"></span>
                                    <p> &nbsp;- Moderate Buy</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#34d1a6]"></span>
                                    <p> &nbsp;- Buy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white border border-gray-300 rounded-md">
                    <p class="px-6 py-4 text-black text-lg border-b border-gray-300">
                        Options Market: STRONG BUY
                    </p>
                    <div class="flex justify-center items-center py-5">
                        <div class="w-[430px] h-[450px] p-4 overflow-hidden relative">
                            <div class="absolute left-0 right-0 bottom-0 top-0 p-3 md:p-0">
                                <canvas id="options-market" width="460" height="250"></canvas>
                            </div>
                            <div class="flex justify-center items-center h-full w-full">
                                <div class="-rotate-[40deg] origin-center-left-mob md:origin-center-left">
                                    <svg class="w-[150px] h-[150px] md:h-[250px] md:w-[230px]" width="230px" height="250px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 4V20M12 4L8 8M12 4L16 8" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 flex flex-wrap gap-5 p-3 md:p-0">
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#C11F1F]"></span>
                                    <p> &nbsp;- Sell</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#c65326]"></span>
                                    <p> &nbsp;- Moderate Sell</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#d1cb34]"></span>
                                    <p> &nbsp;- Hold</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#7ce9cb]"></span>
                                    <p> &nbsp;- Moderate Buy</p>
                                </div>
                                <div class="inline-flex">
                                    <span class="inline-block grow w-8 h-5 bg-[#34d1a6]"></span>
                                    <p> &nbsp;- Buy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-7 mt-10 gap-5 items-end">
                <div class="md:col-span-3">
                    <div class="bg-white w-full border border-gray-300 rounded-md">
                        <p class="px-6 py-4 text-black text-lg border-b border-gray-300">
                            Price target
                        </p>
                        <div class="flex justify-center items-center pt-8 pb-16">
                            <div>
                                <p class="text-black text-5xl">$205.50</p>
                                <p class="text-green-500 text-2xl leading-none pt-5"><span class="inline-block triangle-up border-green-500"></span>&nbsp;31% UPSIDE</p>
                                <p class="text-red-500 text-2xl leading-none"><span class="inline-block triangle-down border-red-500"></span>&nbsp;3% SPY</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-4 self-center">
                    <ul class="[&>li:nth-child(odd)]:bg-gray-200 [&>li:last-child]:border-gray-300 [&>li:last-child]:border-b-2 [&>li:first-child]:border-gray-300 [&>li:first-child]:border-t-2">
                        <li class="flex justify-between items-center py-3 px-2">
                           <p class="text-black">
                                Avg forecast
                            </p>
                            <p class="text-black">
                                $205.50
                            </p>
                        </li>
                        <li class="flex justify-between items-center py-3 px-2">
                            <p class="text-black">
                                High forecast
                             </p>
                             <p class="text-black">
                                 $215.50
                             </p>
                         </li>
                         <li class="flex justify-between border-t-2 border-gray-300 items-center py-3 px-2">
                            <p class="text-black">
                                Low forecast
                             </p>
                             <p class="text-black">
                                 $185.50
                             </p>
                         </li>
                         <li class="flex justify-between items-center py-3 px-2">
                            <p class="text-black">
                                 # of Analyst
                             </p>
                             <p class="text-black">
                                 27
                             </p>
                         </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section pt-10 pb-[300px]">
            <div id="ratings-symbol-table"></div>
        </section>
    </main>
</x-front.layout>
