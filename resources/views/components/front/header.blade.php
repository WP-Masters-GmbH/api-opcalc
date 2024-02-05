<div class="header fixed top-0 w-full z-50">
    <header class="bg-dark-primary pl-12 pt-3 pb-4 pr-5">
        <div class="flex justify-between items-center">
        <a href="/" class="flex gap-[6px] items-center">
            <img
            width="32"
            height="30"
            loading="lazy"
            class="w-8 h-[30px]"
            src="/images/Logo.svg?11"
            alt="Logo"
            />
            <p class="capitalize text-on-dark text-lg lg:text-[22px]">
            Option profit calculator
            </p>
        </a>
        <div class="hidden lg:block">
            <div class="flex gap-[27px] items-center">
            <nav>
                <ul class="flex gap-6">
                    @foreach ($menuItems as $menuItem)
                    <li>
                        <a href="{{ $menuItem['link'] }}" class="menu-link">{{ $menuItem['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </nav>
            <div class="flex gap-[9px]">
                <a href="/login" class="outlined-button"> Login </a>
                <a href="/register" class="orange-button"> Register </a>
            </div>
            </div>
        </div>

        <button class="block lg:hidden show-menu">
            <img
            width="40"
            height="40"
            class="w-10 h-10"
            src="/images/burger.svg?11"
            alt="Burger"
            />
        </button>
        </div>
    </header>
    <div class="mobile-menu">
        <div
          class="flex gap-[27px] flex-col bg-dark-primary pt-3 pl-5 pr-5 pb-5 w-screen"
        >
          <div class="flex justify-between items-center">
            <a href="/" class="flex gap-[6px] pl-7 items-center">
              <img
                width="32"
                height="30"
                class="w-8 h-8"
                src="/images/Logo.svg?11"
                alt="Logo mobile"
              />
              <p class="capitalize text-on-dark text-lg lg:text-[22px]">
                Option Profit Calculator
              </p>
            </a>
            <button class="close-menu">
              <img
                width="40"
                height="40"
                class="w-10 h-10"
                src="/images/close.svg??"
                alt="Close"
              />
            </button>
          </div>
          <nav>
            <ul class="flex gap-6 flex-col">
                @foreach ($menuItems as $menuItem)
                <li>
                    <a href="{{ $menuItem['link'] }}" class="menu-link">{{ $menuItem['title'] }}</a>
                </li>
                @endforeach
            </ul>
          </nav>
          <div class="flex gap-[9px]">
            <a href="/login" class="outlined-button"> Login </a>
            <a href="/register" class="orange-button"> Register </a>
        </div>
        </div>
      </div>
    </div>
</div>