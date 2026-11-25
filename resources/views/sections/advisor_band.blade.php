<section class="max-w-[1280px] mx-auto px-6 py-12 md:py-16 font-source">
  {{-- Card Container: background #31866A / deep emerald tone, rounded-2xl / rounded-3xl --}}
  <div class="bg-[#122A21] rounded-[24px] md:rounded-[28px] p-8 md:p-14 lg:p-16 text-white grid md:grid-cols-2 gap-10 lg:gap-14 items-center shadow-xl">
    
    {{-- Left Side: Heading, Subtext, Action Buttons --}}
    <div class="flex flex-col items-start font-source">
      <h2 class="font-heading font-medium text-4xl md:text-[46px] lg:text-[50px] leading-[1.15] text-white">
        {!! $c['heading_html'] ?? '' !!}
      </h2>

      @if(!empty($c['subtext']))
      <p class="mt-6 text-base md:text-[17px] text-white/80 font-source leading-relaxed max-w-lg">
        {{ $c['subtext'] }}
      </p>
      @endif

      <div class="mt-8 flex flex-wrap gap-4 items-center font-source">
        @if(!empty($c['button_text']))
        <a href="{{ $c['button_link'] ?? '/enquiry' }}" class="inline-flex items-center justify-center bg-[#C4A06B] hover:bg-[#B38F5B] text-white text-sm font-semibold font-source px-7 py-3.5 rounded-[10px] shadow-sm transition-colors">
          {{ $c['button_text'] }}
        </a>
        @endif

        @if(!empty($c['button2_text']))
        <a href="{{ $c['button2_link'] ?? 'https://wa.me/971500000000' }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white text-sm font-semibold font-source px-7 py-3.5 rounded-[10px] shadow-sm transition-colors">
          {{-- WhatsApp Icon --}}
          <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.586 1.761.882 2.791.882h.001c3.181 0 5.767-2.587 5.768-5.766.001-3.181-2.585-5.768-5.769-5.768zm7.545 5.766c-.002 4.153-3.38 7.531-7.536 7.531-1.309 0-2.548-.342-3.649-.997l-4.041 1.06 1.079-3.933c-.73-1.157-1.114-2.502-1.115-3.661.002-4.153 3.38-7.531 7.536-7.531 4.154 0 7.528 3.377 7.526 7.531z"/></svg>
          <span>{{ $c['button2_text'] }}</span>
        </a>
        @endif
      </div>
    </div>

    {{-- Right Side: Simulated Chat Window Card --}}
    <div class="bg-[#0b1a14]/60 border border-white/10 rounded-[20px] p-6 lg:p-8 flex flex-col justify-center min-h-[300px] font-source">
      <div class="space-y-4 text-xs md:text-sm font-source">
        @foreach(($c['chat_messages'] ?? []) as $m)
          @if(($m['side'] ?? 'left') === 'right')
            {{-- User Right Message --}}
            <div class="flex justify-end">
              <div class="bg-[#1C4336] text-white/95 rounded-[14px] rounded-br-none py-3 px-4 max-w-[85%] leading-relaxed shadow-sm">
                {{ $m['text'] }}
              </div>
            </div>
          @else
            {{-- Advisor Left Message --}}
            <div class="flex justify-start">
              <div class="bg-[#163026] text-white/90 rounded-[14px] rounded-bl-none py-3 px-4 max-w-[85%] leading-relaxed shadow-sm border border-white/5">
                {{ $m['text'] }}
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

  </div>
</section>
