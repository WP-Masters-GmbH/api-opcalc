<x-front.layout title="{{ $title }}">
    <main class="mt-[68px] vr-styles">
        <section class="section pt-8 pb-8">
            <h1>Search Chain by Symbol</h1>
            <div class="form-search-symbol">
                <form action="{{ route('search-chain-symbol') }}" method="POST">
                    @csrf
                    <div class="flexed-input-search">
                        <input type="text" name="symbol" placeholder="Symbol name - AAPL etc." required>
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-front.layout>
