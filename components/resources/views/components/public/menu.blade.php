<div class="dropdown-menu">

     @foreach($childs as $key => $child)

        @if(count($child['children']))

            <div class="dropend">
                <a class="dropdown-item dropdown-toggle" href="#navbarDropdownMenuChild" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                   @if ( !empty($child['icon']) )
                     <i class="{{ $child['icon'] }} me-2"></i>
                   @endif
                    {{ __($child['text']) }}
                </a>
                <div class="dropdown-menu">
                    @foreach ($child['children'] as $key => $value)
                        <a class="dropdown-item" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}" target="{{ $value['target'] }}">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} me-2"></i>
                           @endif
                            {{ __($value['text']) }}
                        </a>
                    @endforeach
                </div>
            </div>

        @else
            <a class="dropdown-item" href="{{ ( $child['menu_items']  == 'custom' ) ? $child['url'] : route('home') . '/' . $child['url'] }}">
               @if ( !empty($child['icon']) )
                 <i class="{{ $child['icon'] }} me-2"></i>
               @endif
                {{ __($child['text']) }}
            </a>
        @endif

     @endforeach

</div>