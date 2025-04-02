@if ( $page->type == 'tool')
    <section id="tool-box">
        <div class="card mb-3">
        <div class="card-body">

          @switch($page->tool_name)

              @case('Disclaimer Generator')
                    @livewire('public.tools.disclaimer-generator')
                  @break

              @case('Terms And Condition Generator')
                    @livewire('public.tools.terms-and-condition-generator')
                  @break
                  
              @case('Privacy Policy Generator')
                    @livewire('public.tools.privacy-policy-generator')
                  @break

              @case('XML to JSON')
                    @livewire('public.tools.xml-to-json')
                  @break
                  
              @case('CSV to JSON')
                    @livewire('public.tools.csv-to-json')
                  @break

              @case('TSV to JSON')
                    @livewire('public.tools.tsv-to-json')
                  @break

              @case('JSON to XML')
                    @livewire('public.tools.json-to-xml')
                  @break

              @case('JSON to CSV')
                    @livewire('public.tools.json-to-csv')
                  @break

              @case('JSON to Text')
                    @livewire('public.tools.json-to-text')
                  @break

              @case('JSON to TSV')
                    @livewire('public.tools.json-to-tsv')
                  @break

              @case('JSON Minify')
                    @livewire('public.tools.json-minify')
                  @break

              @case('JSON Editor')
                    @livewire('public.tools.json-editor')
                  @break

              @case('JSON Validator')
                    @livewire('public.tools.json-validator')
                  @break

              @case('JSON Formatter')
                    @livewire('public.tools.json-formatter')
                  @break

              @case('JSON Viewer')
                    @livewire('public.tools.json-viewer')
                  @break

              @case('Roman Numerals to Number')
                    @livewire('public.tools.roman-numerals-to-number')
                  @break

              @case('Number to Roman Numerals')
                    @livewire('public.tools.number-to-roman-numerals')
                  @break
                  
              @case('Charge Converter')
                    @livewire('public.tools.charge-converter')
                  @break

              @case('Torque Converter')
                    @livewire('public.tools.torque-converter')
                  @break

              @case('Word to Number Converter')
                    @livewire('public.tools.word-to-number-converter')
                  @break

              @case('Number to Word Converter')
                    @livewire('public.tools.number-to-word-converter')
                  @break

              @case('Currency Converter')
                    @livewire('public.tools.currency-converter')
                  @break

              @case('Angle Converter')
                    @livewire('public.tools.angle-converter')
                  @break

              @case('Frequency Converter')
                    @livewire('public.tools.frequency-converter')
                  @break

              @case('Illuminance Converter')
                    @livewire('public.tools.illuminance-converter')
                  @break

              @case('Volumetric Flow Rate Converter')
                    @livewire('public.tools.volumetric-flow-rate-converter')
                  @break

              @case('Reactive Energy Converter')
                    @livewire('public.tools.reactive-energy-converter')
                  @break

              @case('Energy Converter')
                    @livewire('public.tools.energy-converter')
                  @break

              @case('Apparent Power Converter')
                    @livewire('public.tools.apparent-power-converter')
                  @break

              @case('Reactive Power Converter')
                    @livewire('public.tools.reactive-power-converter')
                  @break

              @case('Power Converter')
                    @livewire('public.tools.power-converter')
                  @break

              @case('Voltage Converter')
                    @livewire('public.tools.voltage-converter')
                  @break

              @case('Current Converter')
                    @livewire('public.tools.current-converter')
                  @break

              @case('Pressure Converter')
                    @livewire('public.tools.pressure-converter')
                  @break

              @case('Pace Converter')
                    @livewire('public.tools.pace-converter')
                  @break

              @case('Speed Converter')
                    @livewire('public.tools.speed-converter')
                  @break

              @case('Parts Per Converter')
                    @livewire('public.tools.parts-per-converter')
                  @break

              @case('Digital Converter')
                    @livewire('public.tools.digital-converter')
                  @break

              @case('Time Converter')
                    @livewire('public.tools.time-converter')
                  @break

              @case('Each Converter')
                    @livewire('public.tools.each-converter')
                  @break

              @case('Temperature Converter')
                    @livewire('public.tools.temperature-converter')
                  @break

              @case('Volume Converter')
                    @livewire('public.tools.volume-converter')
                  @break

              @case('Weight Converter')
                    @livewire('public.tools.weight-converter')
                  @break

              @case('Area Converter')
                    @livewire('public.tools.area-converter')
                  @break

              @case('Length Converter')
                    @livewire('public.tools.length-converter')
                  @break

              @case('GST Calculator')
                    @livewire('public.tools.gst-calculator')
                  @break

              @case('Loan Calculator')
                    @livewire('public.tools.loan-calculator')
                  @break

              @case('CPM Calculator')
                    @livewire('public.tools.cpm-calculator')
                  @break
                  
              @case('Discount Calculator')
                    @livewire('public.tools.discount-calculator')
                  @break

              @case('Paypal Fee Calculator')
                    @livewire('public.tools.paypal-fee-calculator')
                  @break

              @case('Probability Calculator')
                    @livewire('public.tools.probability-calculator')
                  @break

              @case('Margin Calculator')
                    @livewire('public.tools.margin-calculator')
                  @break

              @case('Sales Tax Calculator')
                    @livewire('public.tools.sales-tax-calculator')
                  @break
                  
              @case('Confidence Interval Calculator')
                    @livewire('public.tools.confidence-interval-calculator')
                  @break
                  
              @case('Average Calculator')
                    @livewire('public.tools.average-calculator')
                  @break

              @case('Percentage Calculator')
                    @livewire('public.tools.percentage-calculator')
                  @break

              @case('Age Calculator')
                    @livewire('public.tools.age-calculator')
                  @break

              @case('Decimal to Text')
                    @livewire('public.tools.decimal-to-text')
                  @break

              @case('Text to Decimal')
                    @livewire('public.tools.text-to-decimal')
                  @break

              @case('HEX to Text')
                    @livewire('public.tools.hex-to-text')
                  @break

              @case('Text to HEX')
                    @livewire('public.tools.text-to-hex')
                  @break

              @case('Octal to Text')
                    @livewire('public.tools.octal-to-text')
                  @break

              @case('Text to Octal')
                    @livewire('public.tools.text-to-octal')
                  @break

              @case('Octal to HEX')
                    @livewire('public.tools.octal-to-hex')
                  @break

              @case('HEX to Octal')
                    @livewire('public.tools.hex-to-octal')
                  @break

              @case('Decimal to Octal')
                    @livewire('public.tools.decimal-to-octal')
                  @break

              @case('Octal to Decimal')
                    @livewire('public.tools.octal-to-decimal')
                  @break

              @case('Binary to Octal')
                    @livewire('public.tools.binary-to-octal')
                  @break

              @case('Octal to Binary')
                    @livewire('public.tools.octal-to-binary')
                  @break

              @case('Decimal to HEX')
                    @livewire('public.tools.decimal-to-hex')
                  @break

              @case('HEX to Decimal')
                    @livewire('public.tools.hex-to-decimal')
                  @break

              @case('Text to ASCII')
                    @livewire('public.tools.text-to-ascii')
                  @break

              @case('ASCII to Text')
                    @livewire('public.tools.ascii-to-text')
                  @break

              @case('Binary to Decimal')
                    @livewire('public.tools.binary-to-decimal')
                  @break

              @case('Decimal to Binary')
                    @livewire('public.tools.decimal-to-binary')
                  @break
                  
              @case('Binary to ASCII')
                    @livewire('public.tools.binary-to-ascii')
                  @break

              @case('ASCII to Binary')
                    @livewire('public.tools.ascii-to-binary')
                  @break
                  
              @case('Binary to HEX')
                    @livewire('public.tools.binary-to-hex')
                  @break

              @case('HEX to Binary')
                    @livewire('public.tools.hex-to-binary')
                  @break
                  
              @case('Random Word Generator')
                    @livewire('public.tools.random-word-generator')
                  @break
                  
              @case('WebP to JPG')
                    @livewire('public.tools.webp-to-jpg')
                  @break

              @case('JPG Converter')
                    @livewire('public.tools.jpg-converter')
                  @break

              @case('PNG to JPG')
                    @livewire('public.tools.png-to-jpg')
                  @break

              @case('JPG to PNG')
                    @livewire('public.tools.jpg-to-png')
                  @break

              @case('RGB to HEX')
                    @livewire('public.tools.rgb-to-hex')
                  @break

              @case('HEX to RGB')
                    @livewire('public.tools.hex-to-rgb')
                  @break

              @case('Random Word Generator')
                    @livewire('public.tools.random-word-generator')
                  @break

              @case('Binary to Text')
                    @livewire('public.tools.binary-to-text')
                  @break

              @case('Text to Binary')
                    @livewire('public.tools.text-to-binary')
                  @break

              @case('SRT to VTT')
                    @livewire('public.tools.srt-to-vtt')
                  @break

              @case('VTT to SRT')
                    @livewire('public.tools.vtt-to-srt')
                  @break

              @case('YouTube Thumbnail Downloader')
                    @livewire('public.tools.youtube-thumbnail-downloader')
                  @break

              @case('Image Resizer')
                    @livewire('public.tools.image-resizer')
                  @break

              @case('Image Converter')
                    @livewire('public.tools.image-converter')
                  @break

              @case('Image Enlarger')
                    @livewire('public.tools.image-enlarger')
                  @break

              @case('Image Cropper')
                    @livewire('public.tools.image-cropper')
                  @break

              @case('Rotate Image')
                    @livewire('public.tools.rotate-image')
                  @break

              @case('Flip Image')
                    @livewire('public.tools.flip-image')
                  @break

              @case('Base64 to Image')
                    @livewire('public.tools.base64-to-image')
                  @break

              @case('Image to Base64')
                    @livewire('public.tools.image-to-base64')
                  @break

              @case('Find Facebook ID')
                    @livewire('public.tools.find-facebook-id')
                  @break

              @case('Remove Line Breaks')
                    @livewire('public.tools.remove-line-breaks')
                  @break

              @case('Word Counter')
                    @livewire('public.tools.word-counter')
                  @break

              @case('Password Generator')
                    @livewire('public.tools.password-generator')
                  @break

              @case('Color Converter')
                    @livewire('public.tools.color-converter')
                  @break

              @case('ICO Converter')
                    @livewire('public.tools.ico-converter')
                  @break

              @case('ICO to PNG')
                    @livewire('public.tools.ico-to-png')
                  @break

              @case('Case Converter')
                    @livewire('public.tools.case-converter')
                  @break

              @case('Lorem Ipsum Generator')
                    @livewire('public.tools.lorem-ipsum-generator')
                  @break

              @case('QR Code Generator')
                    @livewire('public.tools.qr-code-generator')
                  @break

              @case('QR Code Decoder')
                    @livewire('public.tools.qr-code-decoder')
                  @break

              @case('Javascript Obfuscator')
                    @livewire('public.tools.javascript-obfuscator')
                  @break

              @case('Javascript DeObfuscator')
                    @livewire('public.tools.javascript-de-obfuscator')
                  @break

              @case('Base64 Encode')
                    @livewire('public.tools.base64-encode')
                  @break

              @case('Base64 Decode')
                    @livewire('public.tools.base64-decode')
                  @break

              @case('HTML Encode')
                    @livewire('public.tools.html-encode')
                  @break

              @case('HTML Decode')
                    @livewire('public.tools.html-decode')
                  @break

              @case('URL Encode')
                    @livewire('public.tools.url-encode')
                  @break

              @case('URL Decode')
                    @livewire('public.tools.url-decode')
                  @break

              @case('HTML Minifier')
                    @livewire('public.tools.html-minifier')
                  @break

              @case('HTML Beautifier')
                    @livewire('public.tools.html-beautifier')
                  @break

              @case('CSS Minifier')
                    @livewire('public.tools.css-minifier')
                  @break

              @case('CSS Beautifier')
                    @livewire('public.tools.css-beautifier')
                  @break

              @case('JavaScript Minifier')
                    @livewire('public.tools.javascript-minifier')
                  @break

              @case('JavaScript Beautifier')
                    @livewire('public.tools.javascript-beautifier')
                  @break

              @case('Text to Slug')
                    @livewire('public.tools.text-to-slug')
                  @break

              @case('MD5 Generator')
                    @livewire('public.tools.md5-generator')
                  @break

              @case('What Is My IP')
                    @livewire('public.tools.what-is-my-ip')
                  @break

              @case('IP Address Lookup')
                    @livewire('public.tools.ip-address-lookup')
                  @break
                  
              @default
          @endswitch
          
        </div>
        </div>
        
        @if ( !empty($related_tools) && $general->related_tools && $page->type == 'tool' )
            <section>
                <div class="card mb-3">
                    <div class="d-block card-header related-tools-box text-start {{ ($general->related_tools_background !== 'bg-white') ? $general->related_tools_background . ' text-white' : 'bg-transparent' }}">
                      <h3 class="card-title">{{ __('Related Tools') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          @foreach ($related_tools as $key => $value)
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <a class="card text-decoration-none cursor-pointer item-box" href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            @if ( $general->icon_before_tool_name_status )
                                              <img class="avatar me-3 bg-transparent {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @if (!$general->lazy_loading) src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @endif alt="{{ $value['title'] }}">
                                            @endif
                                            <div class="fw-medium">{{ $value['title'] }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          @endforeach
                      </div>
                    </div>
                </div>
            </section>
        @endif
    </section>
@endif